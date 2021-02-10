<template>
    <div class="card">
        <div class="card-header">Category edit</div>
        <div class="card-body">
            <form method="post" @submit.prevent="editCategory" >
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
                            <<option v-for="c in categories"  :value="c.id">{{ c.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.price">{{ errors.price[0] }}</span>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
            this.axios.get(`/category/${this.$route.params.id}/edit`)
            .then(res=>{
                this.category = res.data.data;
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
        editCategory(){
            this.axios.put(`/category/${this.$route.params.id}`,this.category)
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
