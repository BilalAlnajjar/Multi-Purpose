require('./bootstrap');

import { createApp } from 'vue';
import ExampleComponent from './Components/ExampleComponent';
import ProfileComponent from './Components/ProfileComponent.vue';
import DashboardComponent from './Components/DashboardComponent.vue';

let app = createApp({})
app.component('example-component' , ExampleComponent);
app.component('dashboard' , ExampleComponent);
app.component('profile' , ExampleComponent);

import router from "./routes/routes";
app.use(router);

app.mount("#app")
