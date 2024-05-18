<template>
    <q-btn
       push
       color="deep-orange-10"
       :label="label"
       no-caps
       :loading="loading"
    />
</template>

<script>
export default {
    name: "PrimaryButton",
    props: {
        label: String,
        loading: {
            type: Boolean,
            default: false,
        },
    },
}
</script>

<style scoped>

</style>
