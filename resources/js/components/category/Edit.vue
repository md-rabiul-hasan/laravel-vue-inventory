<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="./">Home</a>
              </li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                </div>
                <div class="card-body">
                  <form @submit.prevent="updateCategory" enctype="multipart/form-data" >
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" v-model="form.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter Employee Name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                      </div>
                     
                    </div>

                   
                    
                    <button type="submit" class="btn btn-primary">Update</button>
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
        name        : null
      },
      errors:{}
    }
  },
  methods:{
    updateCategory(){
        let id = this.$route.params.id;
        axios.patch('/api/category/'+id, this.form)
        .then( (res) => {
            this.$router.push({name: 'all_category'});
            Notification.success("Catgory updated successfully");
        })
        .catch( error => {
            this.errors = error.response.data.errors;
        })
    }
  },
  created(){
      let id = this.$route.params.id;
      axios.get('/api/category/'+id)
      .then( ({data}) => (this.form = data) )
      .catch( console.log('error') )
  }
}
</script>

<style>

</style>