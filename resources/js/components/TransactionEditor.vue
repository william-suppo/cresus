<template>
    <div>
        <h1 class="text-3xl font-extrabold text-primary mb-6">Liste des transactions</h1>

        <div v-if="modal.visible" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <div class="flex items-start justify-between p-5 border-b rounded-t">
                        <h3 class="text-3xl font-semibold text-primary">
                            Edition d'une transaction
                        </h3>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none" @click="cancelModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative p-6 flex-auto">
                        <div class="px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="effected_at">
                                Date d'effet
                            </label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="effected_at" v-model="modal.transaction.effected_at" type="date"/>
                        </div>
                        <div class="px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="label">
                                Libellé
                            </label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="label" v-model="modal.transaction.label" type="text"/>
                        </div>
                        <div class="px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="debit_account_name">
                                Compte débiteur
                            </label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="debit_account_name" name="debit_account_name" type="text" v-model="modal.transaction.debit_account_name">
                        </div>
                        <div class="px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="credit_account_name">
                                Compte créditeur
                            </label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="credit_account_name" name="credit_account_name" type="text" v-model="modal.transaction.credit_account_name">
                        </div>
                        <div class="px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">
                                Montant
                            </label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="amount" name="amount" type="text" v-model="modal.transaction.amount">
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-6 border-t rounded-b">
                        <button class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" @click="save()">
                            Envoyer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-2 bg-white rounded shadow">
            <div class="flex items-center justify-between px-8 py-6">
                <h3 class="font-bold uppercase text-primary">
                    Transactions ordonnées par date la plus récente
                </h3>
                <button class="float-right bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold p-2 rounded" @click="showModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </div>
            <table class="table-auto w-full">
                <thead class="uppercase text-gray-700 text-xs font-bold bg-gray-100 border-t border-gray-300 text-left">
                    <tr>
                        <th class="pl-4 py-2">Date d'effet</th>
                        <th class="pl-4 py-2">Libellé</th>
                        <th class="pl-4 py-2">Compte débiteur</th>
                        <th class="pl-4 py-2">Compte créditeur</th>
                        <th class="pl-4 py-2">Montant</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-300" v-for="transaction in transactions">
                        <td class="pl-4 py-4">{{ transaction.effected_at }}</td>
                        <td class="pl-4 py-4">{{ transaction.label }}</td>
                        <td class="pl-4 py-4">{{ transaction.debit_account_name }}</td>
                        <td class="pl-4 py-4">{{ transaction.credit_account_name }}</td>
                        <td class="pl-4 py-4">{{ transaction.amount }}</td>
                        <td>
                            <button @click="showModal(transaction)" class="bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold p-2 rounded" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button @click="remove(transaction.id)" class="bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold p-2 rounded" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex px-8 py-6 border-t border-gray-300 justify-center">
                <button v-for="page in pages" :class="page.active ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-gray-50'" class="first:rounded-l-md last:rounded-r-md bg-white border-gray-300 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium" v-html="page.label" @click="fetch(page)"></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            transactions: Array,
            pages: Array,
            modal: {
                transaction: {},
                backupTransaction: {},
                visible: false,
            },
        }
    },

    mounted: function () {
        this.fetch();
    },

    methods: {
        fetch: function (page = null) {
            let url = page ? page.url : '/transactions/getAllPaginate';

            axios.get(url)
                .then(response => {
                    this.transactions = _.orderBy(response.data.data, function (transaction) {
                        return new Date(transaction.effected_at);
                    }, 'desc');

                    this.pages = response.data.meta.links;
                });
        },

        save: function () {
            let id = this.modal.transaction.id;
            let method = id ? 'put' : 'post';
            let url = id ? '/transactions/' + id : '/transactions';

            axios[method](url, this.modal.transaction)
                .then(response => {
                    if (! id) {
                        this.transactions.unshift(response.data.data);
                    }

                    this.transactions = _.orderBy(this.transactions, function (transaction) {
                        return new Date(transaction.effected_at);
                    }, 'desc');

                    this.modal.transaction = {};
                    this.modal.visible = false;
                });
        },

        remove: function (id) {
            axios.delete('/transactions/' + id)
                .then(response => {
                    let index = this.transactions.map(transaction => transaction.id).indexOf(id);
                    this.$delete(this.transactions, index);
                });
        },

        showModal: function (transaction = {}) {
            this.modal.backupTransaction = Object.assign({}, transaction);
            this.modal.transaction = transaction;
            this.modal.visible = true;
        },

        cancelModal: function () {
            Object.assign(this.modal.transaction, this.modal.backupTransaction)
            this.modal.backupTransaction = {};
            this.modal.transaction = {};
            this.modal.visible = false;
        },
    }
}
</script>
