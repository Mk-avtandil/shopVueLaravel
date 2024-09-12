<script setup>
  import axios from "axios";
  import {onMounted, ref} from "vue";

  const categories = ref()

  onMounted(async () => {
      await getCategories();
  })

  const deleteCategory = async (id) => {
      await axios.delete(`/api/categories/delete/${id}`)
      await getCategories()
  }

  const getCategories = async () => {
      categories.value = (await axios.get('/api/categories')).data
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
          <li class="nav-item mx-2">
              <router-link :to="{name: 'create_category_url'}" class="btn bg-light">Добавить категорию</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h2 class="mt-3">Категории</h2>
    <table class="table w-75">
      <tr>
        <th scope="col">Название</th>
        <th scope="col">Кол-во связанных продуктов</th>
        <th scope="col"></th><th scope="col"></th>
      </tr>
      <tr v-for="category in categories?.data">
          <td>{{ category.name }}</td>
          <td>{{ category.products_count }}шт</td>
          <td>
              <router-link :to="{name: 'edit_category_url', params: {id: category.id}}" class="btn btn-info w-100">Изменить</router-link>
          </td>
          <td>
              <button class="w-100 btn btn-danger" @click.prevent="deleteCategory(category.id)">Удалить</button>
          </td>
      </tr>
    </table>
  </div>
</template>

<style scoped>

</style>
