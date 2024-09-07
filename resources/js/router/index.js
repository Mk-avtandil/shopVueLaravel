import { createRouter, createWebHistory } from "vue-router";

const routes = [

    {
        path: "/",
        name: "products_page",
        component: () => import("../pages/productShow.vue"),
    },
    {
        path: "/createProduct",
        component: () => import("../pages/productCreate.vue"),
    },
    {
        name: "detailUrl",
        path: "/products/detail/:id",
        component: () => import("../pages/productDetail.vue"),
    },
    {
        name: "editeProductUrl",
        path: "/products/edit/:id",
        component: () => import("../pages/productEdit.vue"),
    },
    {
        path: "/showCategory",
        component: () => import("../pages/categoryShow.vue"),
    },
    {
        path: "/createCategory",
        component: () => import("../pages/categoryCreate.vue"),
    },
    {
        name: "editCategoryUrl",
        path: "/categories/edit/:id",
        component: () => import("../pages/categoryEdit.vue"),
    },
    {
        path: "/showCart",
        component: () => import("../pages/cartShow.vue"),
    },
    {
        path: "/login",
        name: "login_page",
        component: () => import("../pages/loginComponent.vue"),
    },
    {
        path: "/register",
        component: () => import("../pages/registerComponent.vue"),
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
