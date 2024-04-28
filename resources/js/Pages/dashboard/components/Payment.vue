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
            {{ getSign(payment.amount) }} {{ currencySymbol }} {{ payment.amount }}
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
}
</script>

<style lang="scss" scoped>
@import 'resources/saas/pages/shared/payment';
</style>
