<template>
    <div class="card">
        <div class="card-header">
            Product List
            <router-link :to="{ name: 'add_product' }" class="btn btn-primary btn-sm" >Add New Product</router-link>
            <router-link :to="{ name: 'categories' }" class="btn btn-primary btn-sm" >Categories</router-link>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Product Name</th>
                        <th>Product Categories</th>
                        <th>Price</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in productList" :key="p.id">
                        <td>{{ p.id }}</td>
                        <td>{{ p.name }}</td>
                        <td>
                            <div v-for="c in p.categories">{{ c.category_name.name }}</div>
                        </td>
                        <td>{{ p.price }}</td>
                        <td>
                            <router-link :to="{ name: 'edit_product', params: { id: p.id }}" class="btn btn-block btn-primary btn-sm" >Edit</router-link>

                            <button v-on:click="deleteProduct(p.id)" class="btn btn-block btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name:'products',
    data(){
        return{
            productList:[]
        }
    },
    mounted()
    {
        this.getProductList();
    },
    methods:{
        getProductList(){
            this.axios.get('/product')
            .then(res=>{
                this.productList = res.data.data;
            }).catch(err=>{
                console.log(err);
            });
        },
        deleteProduct(id){
            this.axios.delete(`/product/${id}`)
            .then(res=>{
                this.getProductList();
            }).catch(err=>{
                console.log(err);
            });
        }
    }
}
</script>
