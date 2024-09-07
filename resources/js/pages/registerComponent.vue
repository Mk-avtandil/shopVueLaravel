<script>
    import axios from "axios";
    import {ref} from "vue";
    import { useRouter } from "vue-router";

    export default {
        setup() {
            const router = useRouter();
            const registerData = ref({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            });

            const register = async () => {
                await axios.post('/api/register', registerData.value).then((res) => {
                    localStorage.setItem('token', res.data.access_token);
                    router.push({name: 'login_page'});
                }).catch(error => {
                    if (error.response?.data.errors) {
                        Object.keys(error.response.data.errors).map(key => {
                            errors.value[key] = error.response.data.errors[key][0]
                            errors.value.fatal = error.response.data.errors[key][0]
                        })
                    }
                    console.log("something was wrong");
                });
            }
            return {
                registerData,
                register
            };
        }
    }
</script>

<template>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <router-link to="/" class="navbar-brand text-light" type="submit">SHOP</router-link>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav p-2">
                <li class="nav-item mx-2">
                    <router-link to="/" class="btn bg-light" type="submit">Главная</router-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="login_page w-50 my-5 mx-auto">
        <h2 class=" text-center">Register</h2>
        <form @submit.prevent="register">
            <div class="mb-2">
                <label for="name" class="form-label">Name:</label>
                <input class="form-control" type="text" v-model="registerData.name" id="name" required/>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input class="form-control" type="email" v-model="registerData.email" id="email" required/>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password:</label>
                <input class="form-control" type="password" v-model="registerData.password" id="password" required/>
            </div>
            <div class="mb-2">
                <label for="passwordConfirm" class="form-label">Confirm password:</label>
                <input class="form-control" type="password" v-model="registerData.password_confirmation" id="passwordConfirm" required/>
            </div>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
</div>
</template>

<style scoped>

</style>
