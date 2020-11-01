<template>
   <div>
      
       <input type="text" v-model="searchTerm" class="form-control" style="width:300px;" placeholder="Search">
       <br>
               <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Order</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Pay</th>
                        <th>Due</th>
                        <th>payBy</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filtersearch" :key="order.id">
                        <td>{{order.name}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.pay}}</td>
                        <td>{{order.due}}</td>
                        <td>{{order.payby}}</td>
                        <td>
                          <router-link  :to="{name:'view-order',params:{id:order.id}}" class="btn btn-sm btn-primary">view</router-link>
                      
                           
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
      this.$router.push({name:'/'})
    }
  },
  data(){
    return{
      orders:[],
      searchTerm:''

    }
  },
  computed:{
    filtersearch(){
      return  this.orders.filter(order =>{
        return order.name.match(this.searchTerm)
      })
    }

  },

  methods:{
    allOrder(){
      axios.get('/api/order/')
      .then(({data}) => (this.orders=data))
      .catch()
    },
  
     
  },
  created(){
    this.allOrder();
  }
}
</script>
<style scoped>

</style>