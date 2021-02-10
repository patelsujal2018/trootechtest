<template>
    <div class="card">
        <div class="card-header">
            Category List
            <router-link :to="{ name: 'add_category' }" class="btn btn-primary btn-sm" >Add New Category</router-link>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Category Name</th>
                        <th>Parent Category</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in categoryList" :key="p.id">
                        <td>{{ p.id }}</td>
                        <td>{{ p.name }}</td>
                        <td>
                            <div v-if="p.parent">{{ p.parent.name }}</div>
                        </td>
                        <td>
                            <router-link :to="{ name: 'edit_category', params: { id: p.id }}" class="btn btn-block btn-primary btn-sm" >Edit</router-link>

                            <button v-on:click="deleteCategory(p.id)" class="btn btn-block btn-danger btn-sm">Delete</button>
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
    name:'categories',
    data(){
        return{
            categoryList:[]
        }
    },
    mounted()
    {
        this.getCategoryList();
    },
    methods:{
        getCategoryList(){
            this.axios.get('/category')
            .then(res=>{
                this.categoryList = res.data.data;
            }).catch(err=>{
                console.log(err);
            });
        },
        deleteCategory(id){
            this.axios.delete(`/category/${id}`)
            .then(res=>{
                this.getCategoryList();
            }).catch(err=>{
                console.log(err);
            });
        }
    }
}
</script>
