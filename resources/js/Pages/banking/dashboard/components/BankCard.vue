<template>
    <div class="bank-card"
         :style="{ color: bankAccount.bank.text_color, backgroundColor: bankAccount.bank.bg_color }">

        <div class="flex items-center justify-between">
            <!-- Balance -->
            <div class="flex flex-col gap-2">
                <div>Balance</div>
                <div> {{ formattedBalance }} </div>
            </div>

            <!-- Bank Name -->
            <div class="bank-card__bank-name">
                {{ bankAccount.bank.name }}
            </div>
        </div>

        <div class="flex items-center justify-between">
            <!-- Account Number / Sort Code -->
            <div class="flex flex-col gap-1">
                <div>Account number: {{ bankAccount.account_number }}</div>
                <div>Sort Code: {{ bankAccount.sort_code }}</div>
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

<script>
import helpers from "@/helpers.js"

export default {
    name: "BankCard",
    mixins: [helpers],
    props: {
        bankAccount: Object,
    },
    computed: {
        formattedBalance() {
            let balance = this.bankAccount.balance;
            const sign = this.getSign(balance)
            if (balance < 0) balance = Math.abs(balance);
            return sign + this.formatCurrency(balance, this.bankAccount.currency.symbol)
        },
    },
}
</script>

<style lang="scss" scoped>
@import '../../../../../saas/pages/dashboard/bank-card';
</style>
