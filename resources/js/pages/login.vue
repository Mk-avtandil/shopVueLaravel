<script setup>
import axios from "axios";
import {ref} from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const isHowPass = ref(false);
const data = ref({
    email: '',
    password: ''
});

const errors = ref({
    email: '',
    password: '',
});

const login = async () => {
    try {
        const response = await axios.post('/api/login', {
            email: data.value.email,
            password: data.value.password
        });

        localStorage.setItem("token", response.data.access_token);

        router.push({name: 'products_page_url'});
    } catch (error) {
        if (error.response?.data.errors) {
            Object.keys(error.response.data.errors).forEach(key => {
                errors.value[key] = error.response.data.errors[key][0];
            });
        } else {
            console.error("Something went wrong", error);
        }
    }
};
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
            <h2 class=" text-center">Login</h2>
            <form @submit.prevent="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input v-model="data.email" class="form-control" type="email" id="email" required/>
                    <span v-if="errors.email">{{errors.email}}</span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input v-model="data.password" :type="isHowPass ? 'text' : 'password'" class="form-control" type="password" id="password" required/>
                    <button class="btn btn-primary my-2" @click="isHowPass = !isHowPass">Показать пароль</button>
                    <span v-if="errors.password">{{errors.password}}</span>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
                <router-link :to="{name: 'register_page_url'}" class="btn btn-primary mx-2">Register</router-link>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
