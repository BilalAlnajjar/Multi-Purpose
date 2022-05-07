require('./bootstrap');

import { createApp } from 'vue';
import ExampleComponent from './Components/ExampleComponent';
import ProfileComponent from './Components/ProfileComponent.vue';
import DashboardComponent from './Components/DashboardComponent.vue';
import Users from './Components/Users';

let app = createApp({})
app.component('example-component' , ExampleComponent);
app.component('dashboard' , DashboardComponent);
app.component('profile' , ProfileComponent);
app.component('users' , Users);

import router from "./routes/routes";
app.use(router);

app.mount("#app")
