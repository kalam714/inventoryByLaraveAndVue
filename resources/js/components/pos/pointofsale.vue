<template>
   <div>
           <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
           
            
         
        

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                
                </div>
                <div class="card-body">
                  <div class="chart-area">
               <div class="table-responsive" style="font-size:10px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{cart.product_name}}</td>
                        <td><input type="text" readonly="" style="width:15px;"  :value="cart.product_quantity">
                        <button @click.prevent="increment(cart.id)" style="width:10px; height:10px" class="btn btn-sm btn-success">+</button>
                        <button @click.prevent="decrement(cart.id)" style="width:10px; height:10px" class="btn btn-sm btn-danger"
                         v-if="cart.product_quantity >=2">-</button>
                         <button style="width:10px; height:10px" class="btn btn-sm btn-danger" v-else="" disabled=""></button>
                        </td>
                        <td>{{cart.product_price}}</td>
                        <td>{{cart.sub_total}}</td>
                        <td><a @click="removeCart(cart.id)" class="btn btn-sm btn-primary">X</a></td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <br>
              <br>
              <br>
              <br>
            <br>
                <div class="card-footer">
                  <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center"><strong> Quantity: {{quantity}}</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Sub Total:$ {{subtotal}}</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Vat: $2</strong></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Totsl:$ {{subtotal * 2/100 +subtotal}}</strong></li>
                  </ul>
                  <br><br>
                  <form @submit.prevent="orderDone">
                    <label>Customer Name</label>
                    <select class="form-control" v-model="customer_id" >
                      <option :value="customer.id" v-for="customer in customers">{{customer.name}}</option>
                      


                    </select>
                      <label>Pay</label>
                      <input type="text" class="form-control" v-model="pay"> 
                      <label>Due</label>
                      <input type="text" class="form-control" v-model="due">
                      <label>Pay By</label>
                    <select class="form-control" v-model="payby" >
                      <option value="Handcash">Hand Cash</option>
                      <option value="Check">Check</option>
                      <option value="Gigtcard">Gift Card</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>

                  </form>
                </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                
                </div>

  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
  </li>
  <li class="nav-item" role="presentation"  v-for="category in categories" :key="category.id">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" 
    aria-controls="profile" aria-selected="false" @click="subProduct(category.id)">{{category.category_name}}</a>
  </li>
 
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card-body">
                     <input type="text" v-model="searchTerm" class="form-control" style="width:300px;" placeholder="Search">
                     <br>
                    <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"  v-for="product in filtersearch" :key="product.id">
                    <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                <div class="card" style="width: 6.5rem; margin-bottom:5px;">
                <img :src="product.image"  width="230px" height="80px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{product.product_name}} <strong>$ {{product.selling_price}}</strong></h5>
                    <span class="btn btn-success" v-if="product.product_quantity >=1" >Available {{product.product_quantity}}</span>
                        <span class="btn btn-danger" v-else="">StockOut</span>
                </div>
                </div></button>

                    </div>

                </div>
             
                </div>
  </div>
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card-body">
      <input type="text" v-model="getsearchTerm" class="form-control" style="width:300px;" placeholder="Search">
                     <br>
                    <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"  v-for="getproduct in getfiltersearch" :key="getproduct.id">
                    <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
                <div class="card" style="width: 6.5rem; margin-bottom:5px;">
                <img :src="getproduct.image"  width="230px" height="80px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{getproduct.product_name}} <strong>$ {{getproduct.selling_price}}</strong></h5>
                    <span class="btn btn-success" v-if="getproduct.product_quantity >=1" >Available {{getproduct.product_quantity}}</span>
                        <span class="btn btn-danger" v-else="">StockOut</span>
                </div>
                </div></button>

                    </div>

                </div>
  </div>
  </div>
 
</div>

           
                
              </div>
            </div>




       
          </div>
          <!--Row-->

      

      

        </div>
        <!---Container Fluid-->
     
  
   </div>
</template>
<script>
export default {
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },
    created(){
    this.allProduct()
    this.allCategory()
    this.allCustomer()
    this.cartProduct()
    Reload.$on('afterAddCart',() =>{
      this.cartProduct()
    })
    
 
    
  },
  data(){
    return{
      customer_id:'',
      pay:'',
      vat:2,
      due:'',
      payby:'',
     
      products:[],
      categories:'',
      getproudcts:[],
      customers:'',
      searchTerm:'',
      getsearchTerm:'',
      carts:[]

    }
  },
  computed:{
    filtersearch(){
      return  this.products.filter(product =>{
        return product.product_name.match(this.searchTerm)
      })
    },
    getfiltersearch(){
        return  this.getproudcts.filter(getproduct =>{
        return getproduct.product_name.match(this.getsearchTerm)
      })
    },
    quantity(){
      let sum=0
      for(let i=0;i<this.carts.length;i++){
        sum +=(parseFloat(this.carts[i].product_quantity))
      }
      return sum;
    },
    subtotal(){
      let sum=0
      for(let i=0;i<this.carts.length;i++){
        sum +=(parseFloat(this.carts[i].product_quantity) * parseFloat(this.carts[i].product_price));
      }
      return sum;
    },

    orderDone(){
      let total = this.subtotal * 2/100 + this.subtotal
      let data = {quantity:this.quantity,subtotal:this.subtotal,customer_id:this.customer_id,pay:this.pay,due:this.due,
      payby:this.payby,vat:this.vat, total:total}
      axios.post('/api/orderdone',data)
      .then(() =>{
        Notification.success()
        this.$router.push({name:'home'})
      })


  }
  },
  methods:{
    AddToCart(id){
     axios.get('/api/addToCart/'+id)
      .then(() => {
        Reload.$emit('afterAddCart')
        Notification.success()
      })
      .catch()
    },


cartProduct(){
      axios.get('/api/cartProduct/')
      .then(({data}) => (this.carts=data))
      .catch()
    },
  removeCart(id){
     axios.get('/api/removeCart/'+id)
      .then(() => {
        Reload.$emit('afterAddCart')
        Notification.success()
      })
      .catch()
  },
  increment(id){
       axios.get('/api/increment/'+id)
      .then(() => {
        Reload.$emit('afterAddCart')
        Notification.success()
      })
      .catch()

  },
   decrement(id){
       axios.get('/api/decrement/'+id)
      .then(() => {
        Reload.$emit('afterAddCart')
        Notification.success()
      })
      .catch()
  },





    allProduct(){
      axios.get('/api/product/')
      .then(({data}) => (this.products=data))
      .catch()
    },
      allCategory(){
      axios.get('/api/category/')
      .then(({data}) => (this.categories=data))
      .catch()
    },
     allCustomer(){
      axios.get('/api/customer/')
      .then(({data}) => (this.customers=data))
      .catch()
    },
      subProduct(id){
      axios.get('/api/get/product/'+id)
      .then(({data}) => (this.getproudcts=data))
      .catch()
    }

  }

}

</script>
<style scoped>

</style>