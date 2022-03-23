<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employee List</h1>
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
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr v-for="employee in filterEmployee" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td>
                          <img :src="employee.photo" alt="" class="employee-img">
                        </td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>{{ employee.joining_date }}</td>
                        <td>
                          <a href="#" class="btn btn-sm btn-primary">Edit</a>
                          <a href="#" class="btn btn-sm btn-danger">Delete</a>
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
      employees : [],
      searchText: ''
    }
  },
  created(){
    this.employeeList();
  },
  methods:{
    employeeList(){
      axios.get('api/employee')
      .then( ({data}) => {
        this.employees = data;
        Notification.success("Employee List Fetching successfully");
      })
      .catch( error => {
        this.errors = error.response.data.errors;
      })
    }
  },
  computed:{
    filterEmployee(){
      return this.employees.filter( employee => {
        return employee.name.match(this.searchText);
      } )
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