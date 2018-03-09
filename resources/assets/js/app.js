
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('moment');
require('./lib/bootstrap-datepicker');
require('./lib/nouislider');
require('./lib/fastclick');
require('./lib/nice-select')
require('./lib/now-ui-kit');
require('./app/main');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });


// import React from "react";
// import { render } from "react-dom";
// import { provider } from "react-redux";
// import store from "./store";
// import Routes from "./routes";
// import { authCheck } from "./modules/auth/store/actions";

// store.dispatch(authCheck());

// render((<Provider store={store} >
// 		<Routes />
// 	</Provider>), document.getElementById("app"));