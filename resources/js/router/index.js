import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Products from '../components/product/Products';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'products',
        path: '/products',
        component: Products
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
