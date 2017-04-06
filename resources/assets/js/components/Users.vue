<template>
    <div>
        <form method="post" v-on:submit.prevent="createUser">
            <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                <input type="text" v-model="user.name" placeholder="Name" class="form-control">
                <span class="help-block" v-for="error in errors.name">{{ error }}</span>
            </div>
            <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                <input type="email" v-model="user.email" placeholder="E-mail" class="form-control">
                <span class="help-block" v-for="error in errors.email">{{ error }}</span>
            </div>
            <div v-bind:class="{'form-group': true, 'has-error': errors.password}">
                <input type="password" v-model="user.password" placeholder="Password" class="form-control">
                <span class="help-block" v-for="error in errors.password">{{ error }}</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Create new user</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <User v-for="user in users" v-bind:user="user" v-on:delete-user="deleteUser"></User>
            </tbody>
        </table>
    </div>
</template>
<script>
    import User from './User.vue';

    export default {
        data: function() {
            return {
                users: [],
                user: {
                    name: '',
                    email: '',
                    password: ''
                },
                errors: []
            }
        },
        created() {
            this.fetchUsers();
        },
        components: { User },
        methods: {
            fetchUsers() {
                this.$http.get('/clients').then(function(response) {
                    this.users = response.data.users;
                })
            },
            createUser() {
                this.$http.post('/clients', this.user).then(function(response) {
                    console.log(response);
                    this.users.push(response.data.user);
                    this.user = {name: '', password: '', email: ''};
                }, function (error) {
                    this.errors = error.data;
                })
            },
            deleteUser(user) {
                this.$http.delete('/clients/' + user.id).then(function(response) {
                    let index = this.users.indexOf(user);
                    this.users.splice(index, 1);
                    console.log(response.data);
                });
            }
        }
    }
</script>
