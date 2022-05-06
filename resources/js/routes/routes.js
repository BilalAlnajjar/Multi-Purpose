import { createApp } from 'vue';
import { createRouter, createWebHistory} from 'vue-router';

const Dasboard = () => import('../Components/DashboardComponent.vue');
const profile = () => import('../Components/ProfileComponent.vue');


let app = createApp({});


let routes = [
    {path: '/profile',name:'profile',component:profile},
    {path: '/dashboard',name:'dashboard',component:Dasboard},
];

 const router = createRouter({
    history: createWebHistory(),
     routes
})

export default router;


