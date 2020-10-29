<template>
   <div>
       <div class="row">
           <router-link to="/customer" class="btn btn-primary">All customer</router-link>

       </div>
       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Update ustomer</h1>
                  </div>
                  <form class="user" @submit.prevent="customerUpdate" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                               <input type="text" class="form-control" id="exampleInputFirstName" 
                      v-model="form.name">
                      <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                            </div>
                             <div class="col-md-6">
                               <input type="email" class="form-control" id="exampleInputFirstName" 
                      v-model="form.email">
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                               <input type="text" class="form-control" id="exampleInputFirstName" 
                      v-model="form.address">
                      <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>
                             <div class="col-md-6">
                               <input type="text" class="form-control" id="exampleInputFirstName" 
                      v-model="form.phone">
                      <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                            </div>
                        </div>
                    </div>

                  
                


                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update</button>
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
        phone:null,
        address:null

        
      },
      errors:{}
    }
  },
  created(){
      let id=this.$route.params.id
      axios.get('/api/customer/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

  },
  methods:{
      customerUpdate(){
        let id=this.$route.params.id
        axios.patch('/api/customer/'+id,this.form)
        .then(()=> {
         this.$router.push({name:'customer'})
         Notification.success()
        })
        .catch(error =>this.errors=error.response.data.errors)
      }
  }
}

</script>
<style scoped>

</style>