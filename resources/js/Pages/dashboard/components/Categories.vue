<template>
    <BankingSection>
        <template #title>Total Spend by Category</template>
        <template #content>
            <CategoriesSpentChart />
        </template>
    </BankingSection>
</template>

<script>
import BankingSection from "@/Layouts/BankingSection.vue";
import CategoriesSpentChart from "@/Pages/dashboard/components/CategoriesSpentChart.vue";

export default {
    name: "Categories",
    components: {
        CategoriesSpentChart,
        BankingSection,
    },
}
</script>

<style scoped>

</style>
