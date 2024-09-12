<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

const categories = ref();
const data = ref(
    {
        name: '',
        price: '',
        description: '',
        category_id: ''
    }
);

onMounted(async () => {
    categories.value = (await axios.get('/api/products/create')).data;
});

const saveProduct = async () => {
    await axios.post(`/api/products/save`, data.value);
    data.value = {
        name: '',
        price: '',
        description: '',
        category_id: ''
    };
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

    <div class="container my-3">
        <h3 class="mb-3">Добавление продукта</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>Название</label>
                <input v-model="data.name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input v-model="data.price" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Описание</label>
                <input v-model="data.description" type="text" class="form-control">
            </div>
            <span class="text-danger"></span>
            <div class="form-group">
            <label>Категория</label>
            <select class="custom-select form-control" v-model="data.category_id">
                <option value="">...</option>
                <option v-for="category in categories?.data" :value=category.id> {{ category.name }}</option>
            </select>
            </div>
            <div class="form-group my-3">
                <button @click.prevent="saveProduct()" class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
