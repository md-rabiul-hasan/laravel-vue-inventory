<template>
  <div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="./">Home</a>
              </li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
                </div>
                <div class="card-body">
                  <form @submit.prevent="storeEmployee" enctype="multipart/form-data" >
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" v-model="form.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter Employee Name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Phone</label>
                          <input type="text" class="form-control" v-model="form.phone" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Address</label>
                          <input type="text" class="form-control" v-model="form.address" id="exampleInputEmail1">
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Salary</label>
                          <input type="text" class="form-control" v-model="form.salary" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">NID</label>
                          <input type="text" class="form-control" v-model="form.nid" id="exampleInputEmail1">
                          <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Joining Date</label>
                          <input type="date" class="form-control" v-model="form.joining_date" id="exampleInputEmail1" />
                          <small class="text-danger" v-if="errors.pasjoining_datesword">{{ errors.joining_date[0] }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <img :src="form.photo"  style="height:60px; width:60px;" />
                          <br>
                          <input type="file" class="custom-file-input" id="customFile" @change="employeePhotoSelect">
                          <label class="custom-file-label" for="customFile">Employee Photo</label>
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
        name        : null,
        email       : null,
        photo       : null,
        phone       : null,
        address     : null,
        salary      : null,
        joining_date: null,
        nid         : null
      },
      errors:{}
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
    employeePhotoSelect(event){
      var file = event.target.files[0];
      if(file.size > 1048770){
        Notification.error("File must be under 1 MB");
      }else{
        let reader = new FileReader();
        reader.onload = event => {
          this.form.photo = event.target.result;
        }
        reader.readAsDataURL(file);
      }
    }
  }
}
</script>

<style>

</style>