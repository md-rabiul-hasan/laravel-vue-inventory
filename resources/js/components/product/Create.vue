<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="./">Home</a>
              </li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                </div>
                <div class="card-body">
                  <form @submit.prevent="storeEmployee" enctype="multipart/form-data" >
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name</label>
                          <input type="text" v-model="form.product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Product Name">
                            <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Code</label>
                          <input type="text" v-model="form.product_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Product Code">
                            <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Product Category</label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                            <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                          </select>
                          <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Supplier</label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">
                            <option :value="supplier.id"  v-for="supplier in suppliers">{{ supplier.name }}</option>
                          </select>
                          <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Root</label>
                          <input type="text" class="form-control" v-model="form.root" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Buying Price</label>
                          <input type="text" class="form-control" v-model="form.buying_price" id="exampleInputEmail1">
                          <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Selling Price</label>
                          <input type="text" class="form-control" v-model="form.selling_price" id="exampleInputEmail1">
                          <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Buying Date</label>
                          <input type="date" class="form-control" v-model="form.buying_date" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Quantity</label>
                          <input type="number" class="form-control" v-model="form.product_quantity" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <img :src="form.image"  style="height:60px; width:60px;" />
                          <br>
                          <input type="file" class="custom-file-input" id="customFile" @change="productPhotoSelect">
                          <label class="custom-file-label" for="customFile">Product Photo</label>
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>


            </div>
          </div>
          <!--Row-->



  </div>
</template>

<script>
export default {
  created(){
    if(!User.loggedIn()){
      this.$router.push('login');
    }
  },
  data(){
    return {
      form:{
        product_name    : null,
        product_code    : null,
        category_id     : null,
        supplier_id     : null,
        root            : null,
        buying_price    : null,
        selling_price   : null,
        buying_date     : null,
        product_quantity: null,
        image           : null,
      },
      errors:{},
      suppliers:[],
      categories:{},
    }
  },
  methods:{
    storeEmployee(){
      axios.post('api/employee', this.form)
      .then( (res) => {
        this.$router.push({name: 'all_employee'});
        Notification.success("Employee added successfully");
      })
      .catch( error => {
        this.errors = error.response.data.errors;
      })
    },
    productPhotoSelect(event){
      var file = event.target.files[0];
      if(file.size > 1048770){
        Notification.error("File must be under 1 MB");
      }else{
        let reader = new FileReader();
        reader.onload = event => {
          this.form.image = event.target.result;
        }
        reader.readAsDataURL(file);
      }
    }
  },
  created(){
    axios.get('api/supplier').then( ({data}) => (this.suppliers = data))
    axios.get('api/category').then( ({data}) => (this.categories = data))
  }
}
</script>

<style>

</style>