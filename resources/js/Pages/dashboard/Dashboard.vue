<template>
    <BankingLayout>
        <div class="flex flex-col items-center gap-5">
            <AddPayment :bank-account-id="mainBankAccount.id" v-if="!isUserBankAccountsLoading"/>
            <AccountPayments v-if="!isUserBankAccountsLoading"
                             :payments="mainBankAccount.payments"
            />
        </div>
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import AddPayment from "@/Pages/dashboard/components/AddPayment.vue";
import AccountPayments from "@/Pages/dashboard/components/AccountPayments.vue";
export default {
    name: 'Dashboard',
    components: {
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
                    console.log(this.userBankAccounts)
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
