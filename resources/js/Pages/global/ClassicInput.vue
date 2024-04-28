<template>
    <q-input
        filled
        v-model="inputText"
        :label="label"
        :class="widthClass"
    />
</template>

<script>
export default {
    name: "ClassicInput",
    props: {
        prevInputText: String | null,
        label: String,
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
