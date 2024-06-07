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
            <div class="h-full flex flex-col">
                <Payment v-for="payment in mainBankAccount?.payments"
                         :key="payment.id"
                         :payment="payment"
                         :currency-symbol="mainBankAccount?.currency?.symbol"
                />

                <div class="mt-auto flex justify-end w-full">
                    <PrimaryButton
                        :label="'+ Add'"
                        @click="showAddPaymentModal = true"
                    />
                </div>
            </div>

            <AddPayment
                v-if="showAddPaymentModal"
                :bank-account-id="mainBankAccount.id"
                :currency-symbol="mainBankAccount.currency.symbol"
                :show-modal="showAddPaymentModal"
                @toggle-modal="this.showAddPaymentModal = $event"
            />
        </template>
    </BankingSection>
</template>

<script>
import Payment from "@/Pages/banking/dashboard/components/Payment.vue";
import BankingSection from "@/Layouts/BankingSection.vue";
import { mapState } from "vuex";
import PrimaryButton from "@/Pages/global/buttons/PrimaryButton.vue";
import AddPayment from "@/Pages/banking/dashboard/components/AddPayment.vue";

export default {
    name: "AccountPayments",
    components: {
        AddPayment,
        PrimaryButton,
        BankingSection,
        Payment,
    },
    data() {
        return {
            showAddPaymentModal: false,
        }
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
