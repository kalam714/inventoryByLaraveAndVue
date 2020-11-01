<template>
   <div>
       <div class="row">
           <router-link to="/order" class="btn btn-primary">Todays Order</router-link>

       </div>
       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Order Details</h1>
                  </div>

            <div class="row">
            <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                </div>
                <div class="table-responsive">
                 <ul class="list-group">
                    <li class="list-group-item"><strong>Name: </strong> {{orders.name}}</li>
                    <li class="list-group-item"><strong>Address: </strong> {{orders.address}}</li>
                    <li class="list-group-item"><strong>Phone: </strong> {{orders.phone}}</li>
                    <li class="list-group-item"><strong>Date: </strong> {{orders.order_date}}</li>
                    <li class="list-group-item"><strong>Paying Method: </strong> {{orders.payby}}</li>
                </ul>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>


           <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                </div>
                <div class="table-responsive">

                 <ul class="list-group">
                    <li class="list-group-item"><strong>Sub Total:$  </strong> {{orders.sub_total}}</li>
                    <li class="list-group-item"><strong>Vat:$ 2 </strong></li>
                    <li class="list-group-item"><strong>Total:$  </strong> {{orders.total}}</li>
                    <li class="list-group-item"><strong>Pay:$  </strong> {{orders.pay}}</li>
                    <li class="list-group-item"><strong>Due:$ </strong> {{orders.due}}</li>
                </ul>

                </div>
                <div class="card-footer"></div>
              </div>
            </div>



          </div>
           <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="detail in order_details">
                        <td>{{detail.product_name}}</td>
                        <td>{{detail.product_code}}</td>
                        <td>{{detail.product_quantity}}</td>
                        <td><img :src="'/'+detail.image" width="30px" height="30px"></td>
                        <td>{{detail.product_price}}</td>
                        <td>{{detail.sub_total}}</td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
           </div>




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
   
      errors:{},
       orders:{},
      order_details:{},
    }
  },
  created(){
      let id=this.$route.params.id
      axios.get('/api/orders/'+id)
      .then(({data}) => (this.orders = data))
      .catch(console.log('error'))

       axios.get('/api/orders/details/'+id)
      .then(({data}) => (this.order_details = data))
      .catch(console.log('error'))


     

  },
  methods:{
    
  }
}

</script>
<style scoped>

</style>