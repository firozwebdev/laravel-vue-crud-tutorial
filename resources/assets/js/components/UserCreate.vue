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
                <label for="password">Password</label>
                <input type="password" name="password"  class="form-control" v-model="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" @click.prevent="addNewUser()">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
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
        
        methods: {
            handleFileUpload(){
                this.file = this.$refs.file.files[0]; //we load all image information in file.
            },
            addNewUser(){
                let formData = new FormData(); // this class will handle all input data
                formData.append('name',this.name);
                formData.append('email',this.email);
                formData.append('password',this.password);
                formData.append('image', this.file, this.file.name);
                
                axios.post('/api/users', formData).then( response => {
                    this.message = response.data.message;
                }).catch( error => {
                    console.log(error);
                });
            }
        }
    }
</script>
