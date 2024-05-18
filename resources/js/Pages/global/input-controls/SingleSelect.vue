<template>
    <q-select :class="widthClass"
              v-model="selectedItem"
              :label=label
              :disable="isLoading"
              :options="options"
              option-value="id"
              option-label="name"
              input-debounce="0"
              rounded
              hide-selected
              bg-color="grey-3"
              use-input
              fill-input
              clearable
              @filter="filterFn"
    >
        <template v-slot:no-option>
            <q-item class="w-full">
                <q-item-section class="text-grey">
                    No results
                </q-item-section>
            </q-item>
        </template>
    </q-select>
</template>

<script>
export default {
    name: "SingleSelect",
    props: {
        allOptions: Array,
        prevSelectedItem: {
            type: [Object, String],
            default: null
        },
        isLoading: Boolean,
        label: String,
        widthClass: {
            type: String,
            default: 'w-44',
        }
    },
    data() {
        return {
            selectedItem: this.prevSelectedItem,
            options: [],
        }
    },
    methods: {
        filterFn(val, update) {
            if (val === '') {
                update(() => {
                    this.options = this.allOptions
                })
                return;
            }

            update(() => {
                const needle = val.toLowerCase();
                if (this.isArrayOfStrings(this.allOptions)) {
                    this.options = this.allOptions.filter(v => v.toLowerCase().indexOf(needle) > -1)
                }
                else if(this.isArrayOfObjects(this.allOptions)) {
                    this.options = this.allOptions.filter(v => v.name.toLowerCase().indexOf(needle) > -1)
                }
            });
        },
        isArrayOfStrings(arr) {
            return Array.isArray(arr) && arr.length > 0 && typeof arr[0] === 'string';
        },
        isArrayOfObjects(arr) {
            return Array.isArray(arr) && arr.length > 0 && typeof arr[0] === 'object';
        }
    },
    watch: {
        selectedItem() {
            this.$emit('update-selected-item', this.selectedItem);
        },
        prevSelectedItem() {
            this.selectedItem = this.prevSelectedItem;
        }
    }
}
</script>

<style scoped>

</style>
