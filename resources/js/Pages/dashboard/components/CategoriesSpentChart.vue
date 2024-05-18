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
    data: function() {
        return {
            options: {
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }]
        }
    }
}
</script>

<style scoped>

</style>
