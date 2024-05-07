<template>
    <BankingLayout>
        <div class="flex flex-col items-center gap-5" v-if="!isUserBankAccountsLoading">
            <BankCards :bank-accounts="userBankAccounts"/>
            <CreateBankAccount />
        </div>
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
import BankCards from "@/Pages/dashboard/components/BankCards.vue";
import CreateBankAccount from "@/Pages/bank-accounts/components/CreateBankAccount.vue";
export default {
    name: 'BankAccounts',
    components: {
        BankCards,
        BankingLayout,
        CreateBankAccount,
    },
    data(){
        return{
            currentUserId: this.$page.props.auth.user.id,
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
