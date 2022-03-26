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
                          <router-link :to="{name: 'edit_employee', params:{ id:employee.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                          <router-link @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</router-link>
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
      searchText: '',
      errors:{}
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
    },
    deleteEmployee(employee_id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this employee!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/employee/'+employee_id)
          .then( () => {
            this.employees = this.employees.filter(employee => {
              return employee.id != employee_id;
            })
            Notification.success("Employee Delete successfully");
          })
          .catch( (res) => {
            this.$router.push({ name: 'all_employee'})
          } )
        }
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