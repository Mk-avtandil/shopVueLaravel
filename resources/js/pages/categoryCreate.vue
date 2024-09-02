<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

const categories = ref();
const name = ref();

onMounted(async () => {
    categories.value = (await axios.get('/api/products/create')).data;
});

const saveCategory = async () => {
    await axios.post(`/api/categories/save`, {name: name.value});
    name.value = '';
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
        <h3 class="mb-3">Добавить категорию</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>Название</label>
                <input v-model="name" type="text" class="form-control">
            </div>
            <div class="form-group my-3">
                <router-link to="/showCategory" class="btn btn-primary" type="submit">Назад</router-link>
                <button @click.prevent="saveCategory()" class="btn btn-primary mx-2" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
