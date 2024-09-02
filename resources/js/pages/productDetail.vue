<script setup>
    import axios from "axios";
    import {useRoute} from "vue-router";
    import {onMounted, ref} from "vue";

    const route = useRoute()
    const product = ref({})
    const category = ref();

    onMounted(async () => {
        product.value = (await axios.get(`/api/products/detail/${route.params.id}`)).data
        category.value = product.value.category.name;
    })

    const addProductToCart = async (id) => {
        await axios.post(`/api/carts/add/${id}`);
    }
</script>


<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">SHOP</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav p-2">
                    <li class="nav-item mx-2">
                        <a href="/" class="btn bg-light" type="submit">Главная</a>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link to="/showCart" class="btn bg-light" type="submit">Корзина</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="mt-3">Продукт</h2>
        <table class="table w-75 table-striped">
            <tr>
                <td><strong>Название: </strong>{{ product.name }}</td>
            </tr>
            <tr>
                <td><strong>Цена: </strong>{{ product.price }}</td>
            </tr>
            <tr>
                <td><strong>Описание: </strong>{{ product.description }}</td>
            </tr>
            <tr>
                <td><strong>Категория: </strong>{{ category }}</td>
            </tr>
            <tr>
                <td><strong>Дата создания: </strong>{{ product.created_at }}</td>
            </tr>
            <tr>
                <td><strong>Дата обновления: </strong>{{ product.updated_at }}</td>
            </tr>
        </table>
        <router-link :to="{name: 'editeProductUrl', params: {id: product.id}}" class="btn btn-warning w-75">Изменить</router-link>
        <button class="w-75 my-2 btn btn-success" @click.prevent="addProductToCart(product.id)">Добавить в корзину</button>
    </div>
</template>

<style scoped>

</style>
