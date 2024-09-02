<script setup>
import axios from "axios";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";

const route = useRoute()
const product = ref({});

onMounted(async () => {
    product.value = (await axios.get(`/api/products/edit/${route.params.id}`)).data;
})
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="/">SHOP</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav p-2">
                    <li class="nav-item mx-2">
                        <a href="/" class="btn bg-light" type="submit">Главная</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <h3 class="mb-3">Обновление продукта</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>Название</label>
                <input name="name" type="text" v-model="product.name" class="form-control">
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input name="price" type="text" v-model="product.price" class="form-control">
            </div>
            <div class="form-group">
                <label>Описание</label>
                <input name="description" type="text" v-model="product.description" class="form-control">
            </div>
            <div class="form-group">
                <label>Категория</label>
                <select class="custom-select form-control" v-model="product.category_id" name="category_id">
                    <option value="{{ product.category_id }}">{{product.category}}</option>
                </select>
            </div>
            <div class="form-group my-3">
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
