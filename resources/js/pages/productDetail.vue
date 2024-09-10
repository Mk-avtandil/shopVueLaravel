<script setup>
    import axios from "axios";
    import {useRoute} from "vue-router";
    import {onMounted, ref} from "vue";

    const route = useRoute()
    const product = ref({})
    const category = ref();
    const comment = ref();
    const user = ref(null);
    const token = localStorage.getItem('token');

    onMounted(async () => {
        product.value = (await axios.get(`/api/products/detail/${route.params.id}`)).data
        await fetchUser();
    })

    const addProductToCart = async (id) => {
        await axios.post(`/api/carts/add/${id}`);
    }

    const createComment = async () => {
        await axios.post(`/api/comments/${route.params.id}/save`, {body: comment.value}, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(async () => {
            product.value = (await axios.get(`/api/products/detail/${route.params.id}`)).data
        });
        comment.value = '';
    };

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
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">SHOP</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav p-2">
                    <li class="nav-item mx-2">
                        <a href="/" class="btn bg-light" type="submit">Главная</a>
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
        <div class="row">
            <div class="col-6">
                <h2 class="mt-3">Продукт</h2>
                <table class="table table-striped">
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
                        <td><strong>Категория: </strong>{{ product.category?.name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата создания: </strong>{{ product.created_at }}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата обновления: </strong>{{ product.updated_at }}</td>
                    </tr>
                </table>
                <div v-if="user">
                    <router-link :to="{name: 'editeProductUrl', params: {id: product.id}}" class="btn btn-warning w-100">Изменить</router-link>
                </div>
                <div v-if="!user">
                    <button class="btn btn-danger w-100">Авторизуйтесь для редактирования</button>
                </div>
                <button class="w-100 my-2 btn btn-success" @click.prevent="addProductToCart(product.id)">Добавить в корзину</button>
            </div>
            <div class="col-6" v-if="user">
                <h2 class="mt-3">Оставить комментарий</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <textarea  class="form-control" rows="8" cols="45" v-model="comment" name="comment"></textarea>
                    </div>
                    <div class="form-group my-3">
                        <button @click.prevent="createComment()" class="btn btn-primary" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <h2 class="mt-3">Комментарии</h2>
                <template v-for="comment in product.comments">
                    <span>user: {{user?.name}}</span>
                    <p class="text-muted">Comment: {{ comment.body}}</p>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
