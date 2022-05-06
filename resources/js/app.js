require('./bootstrap');

import { createApp } from 'vue';
import ExampleComponent from './Components/ExampleComponent';

let app = createApp({})
app.component('example-component' , ExampleComponent);

app.mount("#app")
