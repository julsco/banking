<template>
    <BankingSection>
        <template #title>Total Spend by Category</template>
        <template #content>
            <div v-for="data in paymentData">
                {{ `${data.category_name}: ${data.total_amount}` }}
            </div>
<!--            <CategoriesSpentChart-->
<!--                v-if="!isTotalSpendingLoading"-->
<!--                :categories="categories"-->
<!--                :total-amounts="totalAmounts"-->
<!--                :payments-data="paymentData"-->
<!--            />-->
        </template>
    </BankingSection>
</template>

<script>
import BankingSection from "@/Layouts/BankingSection.vue";
import CategoriesSpentChart from "@/Pages/banking/dashboard/components/CategoriesSpentChart.vue";
import {mapState} from "vuex";

export default {
    name: "Categories",
    components: {
        CategoriesSpentChart,
        BankingSection,
    },
    data() {
        return {
            categories: [],
            startDate: null,
            endDate: null,
            isTotalSpendingLoading: false,
            paymentData: [],
            totalAmounts: [],
        }
    },
    computed: {
        ...mapState('dashboard', {
            mainBankAccount: 'mainBankAccount',
        }),
    },
    created() {
        this.setInitialDates();
        this.getTotalSpendingByCategory();
    },
    methods: {
        getTotalSpendingByCategory() {
            this.isTotalSpendingLoading = true;
            return axios.get(`/api/categories/total-spending/${this.mainBankAccount.id}/2024-05-01/2024-05-31`)
                .then(response => {
                    this.paymentData = response.data;
                    this.categories = this.paymentsData.map(data => data.category_name);
                    this.totalAmounts = this.paymentsData.map(data => data.total_amount);
                })
                .catch(error => console.error(error))
                .finally(() => this.isTotalSpendingLoading = false)
        },
        setInitialDates() {
            const today = new Date();
            const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            this.startDate = firstDayOfMonth.toLocaleDateString();
            this.endDate = today.toLocaleDateString();
        },
        formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1);
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
    },
}
</script>

<style scoped>

</style>
