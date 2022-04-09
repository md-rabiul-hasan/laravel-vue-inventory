<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Category List</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">

              <input type="text" v-model="searchText" class="form-control" style="width: 300px; margin-bottom: 10px;"> 

              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr v-for="category in filterCategory" :key="category.id">
                        <td>{{ category.name }}</td>                        
                        <td>
                          <router-link :to="{name: 'edit_category', params:{ id:category.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                          <button type="button" @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</button>
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
      categories : [],
      searchText: '',
      errors:{}
    }
  },
  created(){
    this.categoryList();
  },
  methods:{
    categoryList(){
      axios.get('api/category')
      .then( ({data}) => {
        this.categories = data;
        Notification.success("Category List Fetching successfully");
      })
      .catch( error => {
        this.errors = error.response.data.errors;
      })
    },
    deleteCategory(category_id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this category!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/category/'+category_id)
          .then( () => {
            this.categories = this.categories.filter(category => {
              return category.id != category_id;
            })
            Notification.success("Category Delete successfully");
          })
          .catch( (res) => {
            this.$router.push({ name: 'all_category'})
          } )
        }
      })
    }
  },
  computed:{
    filterCategory(){
      return this.categories.filter( category => {
        return category.name.match(this.searchText);
      } )
    }
  }
}
</script>

<style>

</style>