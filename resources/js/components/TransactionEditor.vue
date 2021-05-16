<template>
    <div>
        <h1 class="text-3xl font-extrabold text-blue-900 mb-6">Transactions list</h1>

        <div v-if="modal.visible" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Edit transaction
                        </h3>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none" @click="modal.visible = false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <p class="my-4 text-blueGray-500 text-lg leading-relaxed">
                            I always felt like I could do anything. That’s the main
                            thing people are controlled by! Thoughts- their perception
                            of themselves! They're slowed down by their perception of
                            themselves. If you're taught you can’t do anything, you
                            won’t do anything. I was taught I could do everything.
                        </p>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t rounded-b">
                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" @click="modal.visible = false">
                            Close
                        </button>
                        <button class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" @click="save()">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>


<!--        <form class="flex flex-wrap mb-2 bg-white rounded shadow p-4">-->
<!--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">-->
<!--                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="effected_at">-->
<!--                    Effected at-->
<!--                </label>-->
<!--                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="effected_at" name="effected_at" v-model="transaction.effected_at" type="date">-->
<!--            </div>-->
<!--            <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">-->
<!--                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="label">-->
<!--                    Label-->
<!--                </label>-->
<!--                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="label" name="label" type="text" v-model="transaction.label" placeholder="Shopping at ZuperMarket">-->
<!--            </div>-->
<!--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">-->
<!--                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="debit_account_name">-->
<!--                    Debit Account-->
<!--                </label>-->
<!--                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="debit_account_name" name="debit_account_name" type="text" v-model="transaction.debit_account_name">-->
<!--            </div>-->
<!--            <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">-->
<!--                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="credit_account_name">-->
<!--                    Credit Account-->
<!--                </label>-->
<!--                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="credit_account_name" name="credit_account_name" type="text" v-model="transaction.credit_account_name">-->
<!--            </div>-->
<!--            <div class="w-full md:w-1/12 px-3 mb-6 md:mb-0">-->
<!--                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">-->
<!--                    Amount-->
<!--                </label>-->
<!--                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="amount" name="amount" type="text" placeholder="15" v-model="transaction.amount">-->
<!--            </div>-->
<!--            <div class="w-full md:w-1/12 px-3 mb-6 md:mb-0">-->
<!--                <div class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">&nbsp;</div>-->
<!--                <button class="bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold py-3 px-4 rounded" type="button">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />-->
<!--                    </svg>-->
<!--                </button>-->
<!--            </div>-->
<!--        </form>-->
        <div class="mb-2 bg-white rounded shadow">

            <div class="flex items-center justify-between px-8 py-6">
                <h3 class="font-bold uppercase text-gray-700">
                    Transactions order by date
                </h3>
                <button class="float-right bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold p-2 rounded" @click="modal.visible = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </div>
            <table class="table-auto w-full">
                <thead class="uppercase text-gray-700 text-xs font-bold bg-gray-100 border-t border-gray-300 text-left">
                    <tr>
                        <th class="pl-4 py-2">Effected at</th>
                        <th class="pl-4 py-2">Label</th>
                        <th class="pl-4 py-2">Debit Account</th>
                        <th class="pl-4 py-2">Credit Account</th>
                        <th class="pl-4 py-2">Amount</th>
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
                            <button @click="edit(transaction)" class="bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none leading-tight shadow text-white font-bold p-2 rounded" type="button">
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
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            transactions: [],
            transaction: {},
            modal: {
                visible: false,
            },
        }
    },

    mounted: function () {
        this.fetch();
    },

    methods: {
        fetch: function () {
            axios.get('/ajax/transactions')
                .then(response => {
                    this.transactions = response.data.data;
                });
        },

        edit: function (transaction) {
            this.transaction = transaction;
            this.modal.visible = true;
        },

        save: function () {
            this.modal.visible = false;
        },

        remove: function (id) {
            let index = this.transactions.map(transaction => transaction.id).indexOf(id);
            this.$delete(this.transactions, index);

            // axios.delete('/ajax/transactions/' + id)
            //     .then(response => {
            //         let index = this.transactions(transaction => transaction.id).indexOf(id);
            //         this.$delete(this.transactions, index);
            //     });
        },
    }
}
</script>
