<template>
    <div class="payment">
        <!-- Icon -->
        <div class="payment__icon">
            <i class="fa-solid" :class="payment.payment_category.icon"/>
        </div>

        <!-- Description / Category -->
        <div class="flex flex-col">
            <div class="payment__description">{{ payment.description }}</div>
            <div class="payment__category">{{ payment.payment_category.name }}</div>
        </div>

        <!-- Amount -->
        <div class="payment__amount">
            {{ formattedAmount }}
        </div>
    </div>
</template>

<script>
import helpers from "@/helpers"
export default {
    name: "Payment",
    mixins: [helpers],
    props: {
        payment: Object,
        currencySymbol: String,
    },
    computed: {
        formattedAmount() {
            const sign = this.getSign(this.payment.amount);
            const absolutePayment = Math.abs(this.payment.amount);
            const formattedPayment = this.formatCurrency(absolutePayment, this.currencySymbol);

            return `${sign} ${formattedPayment}`;
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/saas/pages/shared/payment';
</style>
