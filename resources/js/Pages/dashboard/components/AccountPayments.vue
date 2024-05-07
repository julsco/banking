<template>
    <BankingSection>
        <template #title>
            <div class="flex items-center justify-between">
                <div>Recent Transactions</div>
                <div class="internal-link"
                     @click="$inertia.visit(`/payments`)">
                    See all
                </div>
            </div>

        </template>
        <template #content>
            <div v-for="payment in mainBankAccount?.payments" :key="payment.id">
                <Payment :payment="payment" :currency-symbol="mainBankAccount?.currency?.symbol"/>
            </div>
        </template>
    </BankingSection>
</template>

<script>
import Payment from "@/Pages/dashboard/components/Payment.vue";
import BankingSection from "@/Layouts/BankingSection.vue";
import { mapState } from "vuex";

export default {
    name: "AccountPayments",
    components: {
        BankingSection,
        Payment,
    },
    computed: {
        ...mapState('dashboard', {
            mainBankAccount: 'mainBankAccount',
        }),
    },
}
</script>

<style scoped>

</style>
