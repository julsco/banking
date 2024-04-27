<template>
    <BankingLayout>
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-4">
                <div class="w-56">Description</div>
                <div class="w-56">Category</div>
                <div class="w-56">Amount</div>
                <div class="w-56">Date</div>
            </div>

            <div class="flex items-center gap-4">
                <q-input
                    filled
                    v-model="paymentDescription"
                    label="Description"
                    class="w-56"
                />
                <q-select
                    v-model="paymentCategory"
                    :options="paymentCategories"
                    label="Category"
                    class="w-56"
                    :loading="isPaymentCategoriesLoading"
                    clearable
                />
                <q-input
                    filled
                    v-model="paymentAmount"
                    label="Amount"
                    class="w-56"
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
    </BankingLayout>
</template>

<script>
import BankingLayout from "@/Layouts/BankingLayout.vue";
export default {
    name: 'Dashboard',
    components: {
        BankingLayout,
    },
    data(){
        return{
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
                        label: category.name
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
                'bank_account_id': 7,
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
