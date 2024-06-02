<template>
    <apexchart
        width="100%"
        height="100%"
        type="bar"
        :options="options"
        :series="series"
    />
</template>

<script>
export default {
    name: "CategoriesSpentChart",
    props: {
        paymentsData: Array,
        categories: Array,
        totalAmounts: Array,
    },
    data () {
        return {
            options: {
                xaxis: {
                    categories: this.categories,
                }
            },
            series: [{
                name: 'Total Amount',
                data: this.totalAmounts,
            }]
        }
    },
}
</script>

<style scoped>

</style>
