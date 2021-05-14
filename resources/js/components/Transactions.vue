<template>
    <div>
        <transactions-form :transactions="transactions"></transactions-form>
        <transactions-list :transactions="transactions"></transactions-list>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            transactions: Array,
        }
    },

    mounted: function () {
        this.getTransactions();
    },

    methods: {
        getTransactions: function () {
            axios.get('/ajax/transactions')
                .then(response => {
                    this.transactions = response.data;
                })
        }
    }
}
</script>

