require('./bootstrap');

import Vue from "vue"

Vue.component("transactions", require("./components/Transactions.vue").default);
Vue.component("transactions-list", require("./components/TransactionsList.vue").default);
Vue.component("transactions-form", require("./components/TransactionsForm.vue").default);

const app = new Vue({
    el : "#app"
});
