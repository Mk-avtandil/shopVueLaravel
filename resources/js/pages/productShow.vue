<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import { useRouter } from 'vue-router';

const products = ref();
const router = useRouter();
const user = ref(null);
const token = localStorage.getItem('token');
const pagination = ref({});


onMounted(async () => {
    await getProducts();
    await fetchUser();
})

const deleteProduct = async (id) => {
    await axios.delete(`/api/products/delete/${id}`)
    await getProducts()
}

const getProducts = async (url = '/api/products') => {
    products.value = (await axios.get(url)).data;

     pagination.value = {
        prev_page_url: products.value.links.prev,
        next_page_url: products.value.links.next
    };
}

const addProductToCart = async (id) => {
    await axios.post(`api/carts/add/${id}`);
}

const fetchUser = async () => {
    try {
        const response = await axios.get('/api/user', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        user.value = response.data;
    } catch (error) {
        console.error('Failed to fetch user', error);
        router.push({ name: 'products_page' });
    }
};

const logout = async () => {
    try {
        await axios.get('/api/logout', {}, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        window.location.reload();
    } catch (error) {
        console.error('Logout failed', error);
    }
};
</script>

<template>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container d-flex">
            <router-link to="/" class="navbar-brand text-light" type="submit">SHOP</router-link>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav p-2">
                    <li class="nav-item mx-2">
                        <router-link to="/showCategory" class="btn bg-light" type="submit">Категории</router-link>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link to="/createProduct" class="btn bg-light">Добавить новые продукты</router-link>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto p-2">
                    <li class="nav-item mx-2">
                        <router-link to="/showCart" class="btn bg-light" type="submit">Корзина</router-link>
                    </li>
                    <li class="nav-item mx-2" v-if="!user">
                        <router-link to="/login" class="btn bg-light" type="submit">Login</router-link>
                    </li>
                    <li class="nav-item max-2" v-if="user">
                        <button class="btn bg-light">{{user?.name}}</button>
                    </li>
                    <li class="nav-item mx-2" v-if="user">
                        <button class="btn bg-light" @click.prevent="logout()">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-3">Продукты</h2>
        <table class="table">
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
            </tr>
            <tr v-for="product in products?.data">
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.category }}</td>
                <td>
                    <router-link :to="{name: 'detailUrl', params: {id: product.id}}" class="btn btn-info w-100">Подробнее</router-link>
                </td>
                <td>
                    <button class="w-100 btn btn-success" @click.prevent="addProductToCart(product.id)">Добавить в корзину</button>
                </td>
                <td>
                    <button class="w-100 btn btn-danger" @click.prevent="deleteProduct(product.id)">Удалить</button>
                </td>
            </tr>
            <button class="btn btn-success text-light" @click.prevent="getProducts(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Предыдущая</button>
            <button class="btn btn-success mx-2" @click.prevent="getProducts(pagination.next_page_url)" :disabled="!pagination.next_page_url">Cледующая</button>
        </table>
    </div>
    </body>
    </html>
</template>

<style scoped>

</style>
