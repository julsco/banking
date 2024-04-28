<template>
    <div class="banking-card">
        <div>Recent Transactions</div>
        <div v-for="payment in payments" :key="payment.id">
            <Payment :payment="payment" :currency-symbol="currencySymbol"/>
        </div>
    </div>
</template>

<script>
import Payment from "@/Pages/dashboard/components/Payment.vue";

export default {
    name: "AccountPayments",
    components: {
        Payment,
    },
    props: {
        payments: Array,
        currencySymbol: String,
    },
}
</script>

<style scoped>

</style>
