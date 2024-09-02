<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

const products = ref();

onMounted(async () => {
    await getProducts()
})

const deleteProduct = async (id) => {
    await axios.delete(`/api/products/delete/${id}`)
    await getProducts()
}

const getProducts = async () => {
    products.value = (await axios.get('/api/products')).data
}

const addProductToCart = async (id) => {
    await axios.post(`api/carts/add/${id}`);
}
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
                    <li class="nav-item mx-2">
                        <router-link to="/login" class="btn bg-light" type="submit">Login</router-link>
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
        </table>
    </div>
    </body>
    </html>
</template>

<style scoped>

</style>
