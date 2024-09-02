<script setup>

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
    <div class="login_page w-50 my-5 mx-auto">
        <h2 class=" text-center">Register</h2>
        <form @submit.prevent>
            <div class="mb-2">
                <label for="name" class="form-label">Name:</label>
                <input class="form-control" type="text" id="name" required/>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input class="form-control" type="email" id="email" required/>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password:</label>
                <input class="form-control" type="password" id="passwoord" required/>
            </div>
            <div class="mb-2">
                <label for="passwordConfirm" class="form-label">Confirm password:</label>
                <input class="form-control" type="password" id="passwordConfirm" required/>
            </div>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
</div>
</template>

<style scoped>

</style>
