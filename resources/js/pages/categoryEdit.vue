<script setup>
import axios from "axios";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";

const route = useRoute()
const category = ref({name: ''});

onMounted(async () => {
    category.value = (await axios.get(`/api/categories/edit/${route.params.id}`)).data
})

const updateCategory = async () => {
    await axios.put(`/api/categories/update/${route.params.id}`, {name: category.value.name})
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
        <h3 class="mb-3">Обновление продукта</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>Название</label>
                <input name="name" type="text" v-model="category.name" class="form-control">
            </div>
            <div class="form-group my-3">
                <router-link :to="{name: 'show_category_url'}" class="btn btn-primary" type="submit">Назад</router-link>
                <button @click.prevent="updateCategory()" class="btn btn-primary mx-2" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
