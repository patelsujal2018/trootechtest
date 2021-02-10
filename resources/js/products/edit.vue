<template>
    <div class="card">
        <div class="card-header">Product edit</div>
        <div class="card-body">
            <form method="post" @submit.prevent="editProduct" >
                <div class="card-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input name="product_name" type="text" class="form-control" placeholder="Enter Product Name" v-model="product.name">
                        <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label>Product price</label>
                        <input name="product_price" type="text" class="form-control" placeholder="Enter Product Price" v-model="product.price">
                        <span class="text-danger" v-if="errors.price">{{ errors.price[0] }}</span>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check" v-for="c in categories" :key="c.id" >
                            <label class="form-check-label"><input class="form-check-input" type="checkbox" name="product_categories[]" :value="c.id" v-model="product.categories" >{{ c.name }}</label>
                            <span class="text-danger" v-if="errors.categories">{{ errors.categories[0] }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <router-link :to="{ name: 'products' }" class="btn btn-primary" >Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name:'edit_product',
    data(){
        return{
            product:{
                name: '',
                price: 0,
                categories: []
            },
            categories:[],
            errors:{}
        }
    },
    mounted()
    {
        this.getProduct();
    },
    methods:{
        getProduct(){
            this.axios.get(`/product/${this.$route.params.id}/edit`)
            .then(res=>{
                this.product = res.data.data.product;
                this.product.categories = res.data.data.categories;
            }).catch(err=>{
                console.log(err);
            });
            
            this.axios.get(`/category`)
            .then(res=>{
                this.categories = res.data.data;
            }).catch(err=>{
                console.log(err);
            });
        },
        editProduct(){
            this.axios.put(`/product/${this.$route.params.id}`,this.product)
            .then(res=>{
                console.log(res.data);
                if(res.data.result == true){
                    this.$router.push({ name : 'products'});
                }
                else{
                    this.errors = res.data.errors;
                }
            }).catch(err=>{
                console.log(err);
            });
        }
    }
}
</script>