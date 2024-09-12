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
        <a class="btn btn-primary" @click.prevent="clearCart()">Очистить корзину</a>
        <router-link to="/" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Оформить заказ</router-link>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Заполните данные</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="InputAddress" class="form-label">Адрес доставки</label>
                            <input type="text" class="form-control" id="InputAddress">
                        </div>
                        <div class="mb-3">
                            <label for="InputPhone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="InputPhone">
                        </div>
                        <h1 class="modal-title fs-5 mt-4 mb-2" id="exampleModalLabel">Банковская карта</h1>
                        <div class="mb-3">
                            <label for="InputCartNumber" class="form-label">Номер карты</label>
                            <input type="text" class="form-control" id="InputCartNumber">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Срок действия</label>
                            <div class="row">
                                <div class="col">
                                    <label for="InputDateCartMonth" class="form-label">Месяц</label>
                                    <input type="text" class="form-control" id="InputDateCartMonth">
                                </div>
                                <div class="col">
                                    <label for="InputDateCartYear" class="form-label">Год</label>
                                    <input type="text" class="form-control" id="InputDateCartYear">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CVV2/CVC2</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" id="InputCVV">
                                </div>
                                <div class="col">
                                    <p>группа из трех цифр на обратной стороне карты</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Заказать</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
