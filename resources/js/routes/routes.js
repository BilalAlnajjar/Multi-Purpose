import { createApp } from 'vue';
import { createRouter, createWebHistory} from 'vue-router';

const Dasboard = () => import('../Components/DashboardComponent.vue');
const profile = () => import('../Components/ProfileComponent.vue');
const users = () => import('../Components/Users.vue');


let app = createApp({});


let routes = [
    {path: '/profile',name:'profile',component:profile},
    {path: '/dashboard',name:'dashboard',component:Dasboard},
    {path: '/users',name:'users',component:users},
];

 const router = createRouter({
    history: createWebHistory(),
     routes
})

export default router;


