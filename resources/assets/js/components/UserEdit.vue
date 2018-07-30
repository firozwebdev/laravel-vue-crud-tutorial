<template>
    <div>
        <div class="alert alert-success" v-if="message">
            {{ message }}
        </div>
        <form action="" class="form-horizontal">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"  class="form-control" v-model="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"  class="form-control" v-model="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" ref="file" v-on:change="handleFileUpload()">
            </div>
           
            <div class="form-group">
                <button type="submit" class="btn btn-default" @click.prevent="updateUser()">Update</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return {
                users: [],
                name: '',
                email: '',
                file: '',
                password: '',
                message: '',
            }
        },

        mounted(){
            axios.get('/api/users/'+this.id).then( response => {
                let user = response.data;
                this.name = user.name;
                this.email = user.email;
            }).catch( error => {
                console.log(error);
            });
        },
        
        methods: {
            handleFileUpload(){
                //we will write logic later....
            },
            updateUser(){
                let formData = new FormData(); // this class will handle all input data
                formData.append('name',this.name);
                formData.append('email',this.email);
                formData.append('_method','PUT'); //sending put method to laravel though we use post method in axios below.
                

                axios.post('/api/users/'+this.id, formData).then( response => {
                    console.log(response);
                    this.message = response.data.message;
                }).catch( error => {
                    console.log(error);
                });
            }
        }
    }
</script>
