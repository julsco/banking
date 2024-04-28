<template>
    <div class="banking-section">
        <div class="banking-section__title">
            <slot name="title"/>
        </div>
        <slot name="content"/>
    </div>
</template>

<script>
export default {
    name: "BankingSection",
}
</script>

<style lang="scss" scoped>
@import 'resources/saas/pages/shared/banking-section';
</style>
