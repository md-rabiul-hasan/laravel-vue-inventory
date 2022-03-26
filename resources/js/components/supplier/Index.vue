<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Supplier List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">

              <input type="text" v-model="searchText" class="form-control" style="width: 300px; margin-bottom: 10px;"> 

              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Shop Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in suppliers" :key="supplier.id">
                          <td>{{ supplier.name }}</td>
                          <td>
                              <img :src="supplier.photo" style="width:40px; height:40px;" alt="">
                          </td>
                          <td>{{ supplier.email }}</td>
                          <td>{{ supplier.phone }}</td>
                          <td>{{ supplier.address }}</td>
                          <td>{{ supplier.shopname }}</td>
                          <td>
                                <router-link :to="{name: 'edit_supplier', params:{ id:supplier.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                                <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</button>
                          </td>
                      </tr>
                      
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
            suppliers: [],
            searchText: '',
            errors:{}
        }
    },
    created(){
        this.getAllSupplier();
    },
    methods:{
        getAllSupplier(){
            axios.get('/api/supplier')
                .then(({data}) => {
                    this.suppliers = data;                    
                })
                .catch( error => {
                    this.errors = error.response.data.errors;
                });
        },
        deleteSupplier(supplier_id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this supplier!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                axios.delete('/api/supplier/'+supplier_id)
                .then( () => {
                    this.suppliers = this.suppliers.filter(supplier => {
                    return supplier.id != supplier_id;
                    })
                    Notification.success("Supplier Delete successfully");
                })
                .catch( (res) => {
                    this.$router.push({ name: 'all_supplier'})
                } )
                }
            })
        }
    }

  
}
</script>

<style>
  .employee-img{
    height: 50px;
    width: 50px;
    border-radius: 50%;
  }
</style>