<template>
<!--    <q-input-->
<!--        filled-->
<!--        v-model="inputText"-->
<!--        :label="label"-->
<!--        :class="widthClass"-->
<!--        mask="$#.##"-->
<!--        prefix="$"-->
<!--        reverse-fill-mask-->
<!--        input-class="text-right"-->
<!--    />-->
    <q-input
        filled
        v-model="inputText"
        :label="label"
        :class="widthClass"
        :prefix="currencySymbol"
    />
</template>

<script>
export default {
    name: "InputMoney",
    props: {
        prevInputText: String | null,
        label: String,
        currencySymbol: String,
        widthClass: {
            type: String,
            default: 'w-44',
        },
    },
    data() {
        return {
            inputText: this.prevInputText,
        };
    },
    watch: {
        prevInputText() {
            this.inputText = this.prevInputText;
        },
        inputText() {
            this.$emit('update-input', this.inputText);
        }
    },
}
</script>

<style scoped>

</style>
