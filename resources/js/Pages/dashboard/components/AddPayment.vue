<template>
    <BankingSection>
        <template #title>Add Payment</template>
        <template #content>
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-4">
                    <div class="w-56">Description</div>
                    <div class="w-56">Category</div>
                    <div class="w-36">Amount</div>
                    <div class="w-56">Date</div>
                </div>

                <div class="flex items-center gap-4">

                    <!-- Description -->
                    <ClassicInput
                        :prev-input-text="paymentDescription"
                        :label="'Description'"
                        :width-class="'w-56'"
                        @update-input="paymentDescription = $event"
                    />

                    <!-- Category -->
                    <SingleSelect
                        :is-loading="isPaymentCategoriesLoading"
                        :all-options="paymentCategories"
                        :label="'Category'"
                        :prev-selected-item="paymentCategory"
                        :width-class="'w-56'"
                        @update-selected-item="paymentCategory = $event"
                    />

                    <!-- Amount -->
                    <InputMoney
                        :prev-input-text="paymentAmount"
                        :label="'Amount'"
                        :width-class="'w-36'"
                        @update-input="paymentAmount = $event"
                    />

                    <q-input filled outlined v-model="paymentDate" mask="####-##-##" :rules="['date']" bg-color="white" color="teal"
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

                    <q-btn
                        @click="createPayment"
                        :disable="isProcessingPayment"
                        color="primary"
                        label="Add Payment"
                        no-caps
                    />
                </div>
            </div>
        </template>
    </BankingSection>
</template>

<script>
import SingleSelect from "@/Pages/global/input-controls/SingleSelect.vue";
import InputClassic from "@/Pages/global/input-controls/ClassicInput.vue";
import ClassicInput from "@/Pages/global/input-controls/ClassicInput.vue";
import InputMoney from "@/Pages/global/input-controls/MoneyInput.vue";
import BankingSection from "@/Pages/global/shared/BankingSection.vue";

export default {
    name: "AddPayment",
    props: {
        bankAccountId: Number,
    },
    components: {
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
                    this.resetPaymentForm();
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isProcessingPayment = false;
                })
        },
    },
}
</script>

<style scoped>

</style>
