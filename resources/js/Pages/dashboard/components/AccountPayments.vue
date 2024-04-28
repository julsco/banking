<template>
    <BankingSection>
        <template #title>Recent Transactions</template>
        <template #content>
            <div v-for="payment in payments" :key="payment.id">
                <Payment :payment="payment" :currency-symbol="currencySymbol"/>
            </div>
        </template>
    </BankingSection>
</template>

<script>
import Payment from "@/Pages/dashboard/components/Payment.vue";
import BankingSection from "@/Pages/global/shared/BankingSection.vue";

export default {
    name: "AccountPayments",
    components: {
        BankingSection,
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
