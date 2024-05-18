<template>
    <q-dialog v-model="displayModal">
        <div class="h-96">
            <BankingSection>
                <template #title>
                    <div class="flex items-center justify-between">
                        <div>Add Payment</div>
                        <i
                            class="fa-solid fa-xmark fa-lg cursor-pointer"
                            v-close-popup
                        />
                    </div>
                </template>
                <template #content>
                    <div class="flex flex-col gap-4">

                        <!-- Description -->
                        <ClassicInput
                            :prev-input-text="paymentDescription"
                            :label="'Description'"
                            :width-class="'w-full'"
                            @update-input="paymentDescription = $event"
                        />

                        <!-- Category -->
                        <SingleSelect
                            :is-loading="isPaymentCategoriesLoading"
                            :all-options="paymentCategories"
                            :label="'Category'"
                            :prev-selected-item="paymentCategory"
                            :width-class="'w-full'"
                            @update-selected-item="paymentCategory = $event"
                        />

                        <div class="flex gap-4">
                            <!-- Amount -->
                            <InputMoney
                                class="flex-auto"
                                :currency-symbol="currencySymbol"
                                :prev-input-text="paymentAmount"
                                :label="'Amount'"
                                :width-class="'w-36'"
                                @update-input="paymentAmount = $event"
                            />

                            <!-- Date -->
                            <q-input filled outlined v-model="paymentDate" mask="####-##-##" :rules="['date']" color="teal"
                            >
                                <template v-slot:append>
                                    <q-icon name="fa-solid fa-calendar-days" class="cursor-pointer">
                                        <q-popup-proxy>
                                            <q-date v-model="paymentDate"
                                                    mask="YYYY-MM-DD"
                                            >
                                                <div class="row items-center justify-end">
                                                    <q-btn v-close-popup label="Close" color="primary" flat/>
                                                </div>
                                            </q-date>
                                        </q-popup-proxy>
                                    </q-icon>
                                </template>
                            </q-input>
                        </div>

                        <div class="ml-auto">
                            <PrimaryButton
                                @click="createPayment"
                                :loading="isProcessingPayment"
                                :label="'Add Payment'"
                            />
                        </div>
                    </div>
                </template>
            </BankingSection>
        </div>
    </q-dialog>
</template>

<script>
import SingleSelect from "@/Pages/global/input-controls/SingleSelect.vue";
import InputClassic from "@/Pages/global/input-controls/ClassicInput.vue";
import ClassicInput from "@/Pages/global/input-controls/ClassicInput.vue";
import InputMoney from "@/Pages/global/input-controls/MoneyInput.vue";
import BankingSection from "@/Layouts/BankingSection.vue";
import PrimaryButton from "@/Pages/global/buttons/PrimaryButton.vue";

export default {
    name: "AddPayment",
    props: {
        bankAccountId: Number,
        currencySymbol: String,
        showModal: Boolean,
    },
    components: {
        PrimaryButton,
        BankingSection,
        InputMoney,
        ClassicInput,
        InputClassic,
        SingleSelect,
    },
    data(){
        return{
            currentUserId: this.$page.props.auth.user.id,
            paymentDescription: '',
            paymentCategory: null,
            isPaymentCategoriesLoading: true,
            paymentCategories: [],
            paymentDate: '',
            paymentAmount: null,
            isProcessingPayment: false,
            displayModal: this.showModal,
        }
    },
    created() {
        this.getAllPaymentCategories();
    },
    methods:{
        resetPaymentForm(){
            this.paymentCategory = null;
            this.paymentDate = null;
            this.paymentAmount = null;
            this.paymentDescription = null;
        },
        getAllPaymentCategories(){
            axios.get('/api/payment-categories')
                .then(response => {
                    this.paymentCategories = response.data.map(category => ({
                        id: category.id,
                        name: category.name
                    }));
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isPaymentCategoriesLoading = false;
                })
        },
        createPayment() {
            this.isProcessingPayment = true;
            axios.post('/api/payment/create', {
                'payment_category_id': this.paymentCategory.id,
                'bank_account_id': this.bankAccountId,
                'description': this.paymentDescription,
                'amount': this.paymentAmount,
                'date': this.paymentDate,
            })
                .then(() => {
                    this.getBankAccountsForUser();
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isProcessingPayment = false;
                })
        },
        getBankAccountsForUser() {
            this.$store.dispatch('dashboard/getBankAccountsForUser')
                .then(() => {
                    this.resetPaymentForm();
                });
        },
    },
    watch: {
        displayModal() {
            this.$emit('toggleModal', this.displayModal)
        },
    },
}
</script>

<style scoped>

</style>
