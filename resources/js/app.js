require('./bootstrap');

import Vue from "vue"

Vue.component("transaction-editor", require("./components/TransactionEditor.vue").default);

const app = new Vue({
    el : "#app"
});
