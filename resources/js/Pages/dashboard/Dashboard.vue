<template>
    <BankingLayout>
        <AddPayment />
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import AddPayment from "@/Pages/dashboard/components/AddPayment.vue";
export default {
    name: 'Dashboard',
    components: {
        AddPayment,
        BankingLayout,
    },
    data(){
        return{
            currentUserId: this.$page.props.auth.user.id,
            userBankAccounts: [],
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
