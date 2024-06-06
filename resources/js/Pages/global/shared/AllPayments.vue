<template>
    <div v-if="!isPaymentsLoading" v-for="(groupedPayments, date) in payments" :key="date" class="w-96">
        <div class="mt-5 mb-2 p-2 bg-gray-200">
            {{ formatDateWithDay(date) }}
        </div>
        <Payment v-for="payment in groupedPayments"
                 :key="payment.id"
                 :payment="payment"
                 :currency-symbol="'£'"
                 class="mb-2"
        />
    </div>
</template>

<script>
import helpers from "@/helpers"
import BankingSection from "@/Layouts/BankingSection.vue";
import BankingLayout from "@/Layouts/BankingLayout.vue";
import Payment from "@/Pages/dashboard/components/Payment.vue";

export default {
    name: "AllPayments",
    layout: BankingLayout,
    mixins: [helpers],
    components: {
        Payment,
        BankingLayout,
        BankingSection,
    },
    data() {
        return {
            payments: [],
            isPaymentsLoading: false,
        }
    },
    created() {
        this.getPaymentsForBankAccount();
    },
    methods: {
        getPaymentsForBankAccount() {
            this.isPaymentsLoading = true;
            return axios.get(`/api/payments/${8}`)
                .then(response => this.payments = response.data)
                .catch(error => console.error(error))
                .finally(() => this.isPaymentsLoading = false)
        },
    },
}
</script>

<style scoped>

</style>
