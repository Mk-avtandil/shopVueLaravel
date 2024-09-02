<script setup>
    import axios from "axios";
    import {onMounted, ref} from "vue";

    const products = ref();

    onMounted(async () => {
        getProductFromCart();
    });

    const getProductFromCart = async () => {
        products.value = (await axios.get('/api/carts')).data
    }

    const clearCart = async () => {
        await axios.post('/api/carts/clear');
        getProductFromCart();
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
        <h2 class="mt-3">Корзина</h2>
        <table class="table">
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
                <th scope="col">Кол-во</th>
                <th></th>
            </tr>
            <tr v-for="item in products?.data">
                <td>{{ item.name  }}</td>
                <td>{{ item.price  }}</td>
                <td>{{ item.category  }}</td>
                <td>{{ item.quantity  }}</td>
            </tr>
        </table>
        <a href="" class="btn btn-primary" @click.prevent="clearCart()">Очистить корзину</a>
    </div>
</template>

<style scoped>

</style>
