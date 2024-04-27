/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { createApp } from 'vue';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css'; // Import Toastr CSS

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import RoleCards from './components/roles/RoleCards.vue';
import UserList from './components/user/UserList.vue';
window.toastr = toastr;
app.component('example-component', ExampleComponent);
app.component('role-cards', RoleCards);
app.component('user-list', UserList);
app.mount('#app');
