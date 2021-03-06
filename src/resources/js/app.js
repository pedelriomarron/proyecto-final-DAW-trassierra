/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
// Trae uno ya
//require('../admin/vendor/jquery/jquery.min.js');
require("../admin/vendor/jquery-easing/jquery.easing.min.js");
//require('../admin/vendor/bootstrap/js/bootstrap.bundle.min.js');
require("../admin/js/sb-admin-2.js");
require("../admin/vendor/datatables/jquery.dataTables.min.js");
require("../admin/vendor/datatables/dataTables.bootstrap4.min.js");
require("../admin/js/demo/datatables-demo.js");
require("../admin/vendor/select2/js/select2.min.js");

require("./functions.js");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "language-switcher",
    require("./components/LanguageSwitcher.vue").default
);

const app = new Vue({
    el: "#app"
});
