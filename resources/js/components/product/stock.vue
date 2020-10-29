<template>
   <div>
       <div class="row">
           <router-link to="/store-product" class="btn btn-primary">Add product</router-link>

       </div>
       <br>
       <input type="text" v-model="searchTerm" class="form-control" style="width:300px;" placeholder="Search">
       <br>
               <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Category</th>
                    
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filtersearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td><img :src="product.image" width="30px" height="30px"></td>
                        <td>{{product.category_name}}</td>
                        <td>{{product.product_quantity}}</td>
                        <td v-if="product.product_quantity >=1"><span class="btn btn-success">Available</span></td>
                        <td v-else=""><span class="btn btn-danger">StockOut</span></td>
                        <td>
                          <router-link  :to="{name:'edit-stock',params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                         
                           
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
      products:[],
      searchTerm:''

    }
  },
  computed:{
    filtersearch(){
      return  this.products.filter(product =>{
        return product.product_name.match(this.searchTerm)
      })
    }

  },

  methods:{
    allProduct(){
      axios.get('/api/product/')
      .then(({data}) => (this.products=data))
      .catch()
    }
 
     
  },
  created(){
    this.allProduct();
  }
}
</script>
<style scoped>

</style>