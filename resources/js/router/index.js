import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "products_page_url",
        component: () => import("../pages/productShow.vue"),
    },
    {
        path: "/create-product",
        name: "create_product_url",
        component: () => import("../pages/productCreate.vue"),
    },
    {
        path: "/products/detail/:id",
        name: "detail_product_url",
        component: () => import("../pages/productDetail.vue"),
    },
    {
        path: "/products/edit/:id",
        name: "edite_product_url",
        component: () => import("../pages/productEdit.vue"),
    },
    {
        path: "/show-category",
        name: "show_category_url",
        component: () => import("../pages/categoryShow.vue"),
    },
    {
        path: "/create-category",
        name: "create_category_url",
        component: () => import("../pages/categoryCreate.vue"),
    },
    {
        path: "/categories/edit/:id",
        name: "edit_category_url",
        component: () => import("../pages/categoryEdit.vue"),
    },
    {
        path: "/show-cart",
        name: "show_cart_url",
        component: () => import("../pages/cartShow.vue"),
    },
    {
        path: "/login",
        name: "login_page_url",
        component: () => import("../pages/login.vue"),
    },
    {
        path: "/register",
        name: "register_page_url",
        component: () => import("../pages/register.vue"),
    },
    {
        path: "/user",
        component: () => import("../pages/productShow.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
