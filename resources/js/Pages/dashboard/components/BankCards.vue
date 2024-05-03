<template>
    <BankingSection>
        <template #title>My Cards</template>
        <template #content>
            <q-carousel
                v-model="slide"
                transition-prev="slide-right"
                transition-next="slide-left"
                swipeable
                animated
                control-color="deep-orange-9"
                navigation
                padding
                arrows
                height="300px"
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
import BankCard from "@/Pages/dashboard/components/BankCard.vue";
import BankAccounts from "@/Pages/bank-accounts/components/CreateBankAccount.vue";
import BankingSection from "@/Pages/global/shared/BankingSection.vue";

export default {
    name: "BankCards",
    components: {
        BankingSection,
        BankCard,
    },
    props: {
        bankAccounts: Array,
    },
    data() {
        return {
            slide: this.bankAccounts[0].id,
        }
    },
}
</script>

<style scoped>

</style>
