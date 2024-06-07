<template>
    <BankingSection>
        <template #title>My Cards</template>
        <template #content>
            <q-skeleton v-if="isUserBankAccountsLoading" height="150px" square />

            <q-carousel
                v-else
                v-model="slide"
                transition-prev="slide-right"
                transition-next="slide-left"
                swipeable
                animated
                control-color="deep-orange-9"
                navigation
                padding
                arrows
                height="400px"
                class="bg-transparent"
            >
                <q-carousel-slide v-for="bankAccount in bankAccounts"
                                  :name="bankAccount.id"
                                  class="column no-wrap flex-center"
                >
                    <BankCard :bank-account="bankAccount" />
                </q-carousel-slide>
            </q-carousel>
        </template>
    </BankingSection>
</template>

<script>
import BankCard from "@/Pages/banking/dashboard/components/BankCard.vue";
import BankingSection from "@/Layouts/BankingSection.vue";
import { mapState } from "vuex";

export default {
    name: "BankCards",
    components: {
        BankingSection,
        BankCard,
    },
    data() {
        return {
            slide: null,
        }
    },
    computed: {
        ...mapState('dashboard', {
            bankAccounts: 'bankAccounts',
            mainBankAccount: 'mainBankAccount',
            isUserBankAccountsLoading: 'isUserBankAccountsLoading',
        }),
    },
    created() {
        this.slide = this.mainBankAccount.id;
    },
}
</script>

<style scoped>

</style>
