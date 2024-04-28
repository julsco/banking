<template>
    <BankingSection>
        <template #title>My cards</template>
        <template #content>
            <div class="bank-card"
                 :style="{ color: bankAccount.bank.text_color, backgroundColor: bankAccount.bank.bg_color }">

                <div class="flex items-center justify-between">
                    <!-- Balance -->
                    <div class="flex flex-col gap-2">
                        <div>Balance</div>
                        <div> {{ balance }} </div>
                    </div>

                    <!-- Bank Name -->
                    <div class="bank-card__bank-name">
                        {{ bankAccount.bank.name }}
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Account Number / Sort Code -->
                    <div class="flex flex-col gap-1">
                        <div>{{ bankAccount.account_number }}</div>
                        <div>{{ bankAccount.sort_code }}</div>
                    </div>
                    <!-- Card Type Logo -->
                    <img
                        :src="bankAccount.card_type.logo_path"
                        alt="Card Type Logo"
                        class="bank-card__card-type"
                    />
                </div>
            </div>
        </template>
    </BankingSection>
</template>

<script>
import BankingSection from "@/Pages/global/shared/BankingSection.vue";
import helpers from "@/helpers"

export default {
    name: "BankCard",
    mixins: [helpers],
    props: {
        bankAccount: Object,
    },
    components: {
        BankingSection,
    },
    computed: {
        balance() {
            const balance = this.bankAccount.payments.reduce((acc, payment) => acc + payment.amount, 0);
            const sign = this.getSign(balance)
            return sign + this.formatCurrency(balance, this.bankAccount.currency.symbol)
        },
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/saas/pages/dashboard/bank-card';
</style>
