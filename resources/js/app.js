require('./bootstrap');

import { createApp } from 'vue';
import Form from 'vform'
import {Button, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform/src/components/bootstrap5'
// 'vform/src/components/bootstrap4'
// 'vform/src/components/tailwind'

window.form = Form;



import ExampleComponent from './Components/ExampleComponent';
import ProfileComponent from './Components/ProfileComponent.vue';
import DashboardComponent from './Components/DashboardComponent.vue';
import Users from './Components/Users';

let app = createApp({})
app.component('example-component' , ExampleComponent);
app.component('dashboard' , DashboardComponent);
app.component('profile' , ProfileComponent);
app.component('users' , Users);


app.component(Button.name, Button)
app.component(HasError.name, HasError)
app.component(AlertError.name, AlertError)
app.component(AlertErrors.name, AlertErrors)
app.component(AlertSuccess.name, AlertSuccess)

import router from "./routes/routes";
app.use(router);

app.mount("#app")
