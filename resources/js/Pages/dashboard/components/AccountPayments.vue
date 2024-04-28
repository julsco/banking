<template>
    <div class="banking-card">
        <div>Recent Transactions</div>
        <div v-for="payment in payments" :key="payment.id">
            <div>{{ payment.description }}</div>
            <div>{{ payment.amount }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AccountPayments",
    props: {
        payments: Array,
    },
}
</script>

<style scoped>

</style>
