<template>
    <div class="mb-2 bg-white rounded shadow">
        <div class="px-8 py-6 font-bold uppercase text-gray-700">
            Transactions order by date
        </div>
        <table class="table-auto w-full">
            <thead class="uppercase text-gray-700 text-xs font-bold bg-gray-100 border-t border-gray-300 text-left">
                <tr>
                    <th class="pl-4 py-2">Effected at</th>
                    <th class="pl-4 py-2">Label</th>
                    <th class="pl-4 py-2">Debit Account</th>
                    <th class="pl-4 py-2">Credit Account</th>
                    <th class="pl-4 py-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t border-gray-300" v-for="transaction in transactions">
                    <td class="pl-4 py-4">{{ transaction.effected_at }}</td>
                    <td class="pl-4 py-4">{{ transaction.label }}</td>
                    <td class="pl-4 py-4">{{ transaction.debit_account.name }}</td>
                    <td class="pl-4 py-4">{{ transaction.credit_account.name }}</td>
                    <td class="pl-4 py-4">{{ transaction.amount }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        transactions: Array,
    },
}
</script>
