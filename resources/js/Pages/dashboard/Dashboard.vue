<template>
    <BankingLayout>
        <div class="dashboard" v-if="!isUserBankAccountsLoading">
            <div class="dashboard__cards">
                <BankCards :bank-accounts="userBankAccounts"/>
            </div>

            <div class="dashboard__chart">
                <DashboardGraph/>
            </div>
            <div class="dashboard__transactions">
                <AccountPayments :payments="mainBankAccount.payments"
                                 :currency-symbol="mainBankAccount.currency.symbol"
                />
            </div>
            <div class="dashboard__categories">
                <Categories/>
            </div>
        </div>
<!--        <AddPayment :bank-account-id="mainBankAccount.id" :currency-symbol="mainBankAccount.currency.symbol"/>-->
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import AddPayment from "@/Pages/dashboard/components/AddPayment.vue";
import AccountPayments from "@/Pages/dashboard/components/AccountPayments.vue";
import BankCards from "@/Pages/dashboard/components/BankCards.vue";
import DashboardGraph from "@/Pages/dashboard/components/DashboardGraph.vue";
import Categories from "@/Pages/dashboard/components/Categories.vue";
export default {
    name: 'Dashboard',
    components: {
        Categories,
        DashboardGraph,
        BankCards,
        AccountPayments,
        AddPayment,
        BankingLayout,
    },
    data(){
        return{
            currentUserId: this.$page.props.auth.user.id,
            userBankAccounts: [],
            mainBankAccount: null,
            isUserBankAccountsLoading: true,
        }
    },
    created() {
        this.getBankAccountsForUser();
    },
    methods:{
        getBankAccountsForUser() {
            axios.get(`/api/bank-accounts/${this.currentUserId}`)
                .then(response => {
                    this.userBankAccounts = response.data;
                    this.mainBankAccount = this.userBankAccounts[0];
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isUserBankAccountsLoading = false;
                })
        },
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/saas/pages/dashboard/dashboard';
</style>
