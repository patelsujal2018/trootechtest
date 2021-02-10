<template>
    <div class="card">
        <div class="card-header">Category Add</div>
        <div class="card-body">
            <form method="post" @submit.prevent="addCategory" >
                <div class="card-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" v-model="category.name">
                        <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control" v-model="category.parent">
                            <option value="">select</option>
                            <<option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.parent">{{ errors.parent[0] }}</span>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <router-link :to="{ name: 'categories' }" class="btn btn-primary" >Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name:'edit_category',
    data(){
        return{
            category:{
                name: '',
                parent: 0,
            },
            categories:[],
            errors:{}
        }
    },
    mounted()
    {
        this.getCategory();
    },
    methods:{
        getCategory(){
            this.axios.get(`/category`)
                .then(res=>{
                    this.categories = res.data.data;
                }).catch(err=>{
                console.log(err);
            });
        },
        addCategory(){
            this.axios.post(`/category/`,this.category)
                .then(res=>{
                    console.log(res.data);
                    if(res.data.result == true){
                        this.$router.push({ name : 'categories'});
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
