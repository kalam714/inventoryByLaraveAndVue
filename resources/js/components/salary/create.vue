<template>
   <div>
       <div class="row">
           <router-link to="/employee" class="btn btn-primary">All Employee</router-link>

       </div>
       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                  </div>
                  <form class="user" @submit.prevent="paidSalary">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                               <input type="text" class="form-control" id="exampleInputFirstName" 
                      v-model="form.name">
                      
                            </div>
                             <div class="col-md-6">
                               <input type="email" class="form-control" id="exampleInputFirstName" 
                      v-model="form.email">
                     
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-row">
                             <div class="col-md-6">
                     <label for="exampleFormControlSelect1">Month</label>
                    
                      <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                           
                            <option value="Jan">Jan</option>
                            <option value="Feb">Feb</option>
                            <option value="Mar">Mar</option>
                            <option value="Apr">Apr</option>
                            <option value="May">May</option>
                            <option value="Jun">Jun</option>
                            <option value="Jul">Jul</option>
                            <option value="Aug">Aug</option>
                            <option value="Sep">Sep</option>
                            <option value="Oct">Oct</option>
                            <option value="Nov">Nov</option>
                            <option value="Dec">Dec</option>
                                                
                        
                      </select>
                      </div>
                             <div class="col-md-6">
                                <label for="exampleFormControlSelect1">Salary</label>
                               <input type="text" class="form-control" id="exampleInputFirstName" 
                      v-model="form.sallary">
                    
                            </div>
                        </div>
                    </div>
                   


                


                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">PayNow</button>
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
      
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
</template>
<script>
export default {
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },
  data(){
    return{
      form:{
        name:null,
        email:null,
        salary_month:null,
        sallary:null,
      
        
      },
      errors:{}
    }
  },
  created(){
      let id=this.$route.params.id
      axios.get('/api/employee/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

  },
  methods:{
         paidSalary(){
        let id=this.$route.params.id
        axios.post('/api/salary/paid/'+id,this.form)
        .then(()=> {
         this.$router.push({name:'given-salary'})
         Notification.success()
        })
        .catch(error =>this.errors=error.response.data.errors)
      }
  }
}

</script>
<style scoped>

</style>