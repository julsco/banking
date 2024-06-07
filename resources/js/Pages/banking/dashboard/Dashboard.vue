<template>
    <div class="dashboard" v-if="!isUserBankAccountsLoading">
        <div class="dashboard__cards">
            <BankCards />
        </div>
        <div class="dashboard__chart">
            <DashboardGraph />
        </div>
        <div class="dashboard__transactions">
            <AccountPayments />
        </div>
        <div class="dashboard__categories">
            <Categories />
        </div>
    </div>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import AddPayment from "@/Pages/banking/dashboard/components/AddPayment.vue";
import AccountPayments from "@/Pages/banking/dashboard/components/AccountPayments.vue";
import BankCards from "@/Pages/banking/dashboard/components/BankCards.vue";
import DashboardGraph from "@/Pages/banking/dashboard/components/DashboardGraph.vue";
import Categories from "@/Pages/banking/dashboard/components/Categories.vue";
import { mapState } from "vuex";
export default {
    name: 'Dashboard',
    layout: BankingLayout,
    components: {
        Categories,
        DashboardGraph,
        BankCards,
        AccountPayments,
        AddPayment,
        BankingLayout,
    },
    mounted() {
        this.getBankAccountsForUser();
    },
    computed: {
        ...mapState('dashboard', {
            isUserBankAccountsLoading: 'isUserBankAccountsLoading',
        }),
    },
    methods:{
        getBankAccountsForUser() {
            this.$store.dispatch('dashboard/getBankAccountsForUser');
        },
    },
}
</script>

<style lang="scss" scoped>
@import '../../../../saas/pages/dashboard/dashboard';
</style>
