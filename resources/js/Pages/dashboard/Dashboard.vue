<template>
    <BankingLayout>
        <div class="flex flex-col items-center gap-5" v-if="!isUserBankAccountsLoading">
            <BankCard :bank-account="mainBankAccount"/>
            <AddPayment :bank-account-id="mainBankAccount.id"/>
            <AccountPayments :payments="mainBankAccount.payments"
                             :currency-symbol="mainBankAccount.currency.symbol"
            />
        </div>
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import AddPayment from "@/Pages/dashboard/components/AddPayment.vue";
import AccountPayments from "@/Pages/dashboard/components/AccountPayments.vue";
import BankCard from "@/Pages/dashboard/components/BankCard.vue";
export default {
    name: 'Dashboard',
    components: {
        BankCard,
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
