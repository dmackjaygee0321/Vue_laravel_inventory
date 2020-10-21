import login from './components/login.vue';
import signup from './components/signup.vue';
import category from './components/category.vue';
import product from './components/product.vue';
import inventory from './components/inventory.vue';


export const routes = [
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'signup',
        path: '/signup',
        component: signup
    }
];

export const routes1 = [
    {
        name: 'category',
        path: '/category',
        component: category
    },
    {
        name: 'product',
        path: '/product',
        component: product
    },
    {
        name: 'inventory',
        path: '/inventory',
        component: inventory
    }
];



