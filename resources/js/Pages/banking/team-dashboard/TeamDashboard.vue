<template>
    <BankingLayout>

    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import BankCards from "@/Pages/banking/dashboard/components/BankCards.vue";
import CreateBankAccount from "@/Pages/banking/bank-accounts/components/CreateBankAccount.vue";
export default {
    name: 'TeamDashboard',
    components: {
        BankingLayout,
    },
}
</script>
