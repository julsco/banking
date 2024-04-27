<template>
    <BankingLayout>
        <q-form>
            <q-select
                v-model="selectedUsers"
                multiple
                :options="allUsers"
                label="Account holder/s"
                class="w-56"
                :loading="isAllUsersLoading"
                clearable
                use-chips
            />

            <q-input
                filled
                v-model="accountNumber"
                label="Account Number*"
                mask="########"
                class="w-56"
                :rules="[ val => val && val.length === 8 || 'Account number must be 8 digits']"
            />

            <q-input
                filled
                v-model="sortCode"
                label="Sort Code"
                mask="##-##-##"
                class="w-56"
                :rules="[ val => val && val.length === 8 || 'Sort Code must be 6 digits']"
            />

            <q-select
                v-model="bank"
                :options="allBanks"
                label="Bank"
                class="w-56"
                :loading="isAllBanksLoading"
                clearable
            />

            <q-select
                v-model="cardType"
                :options="allCardTypes"
                label="Card Type"
                class="w-56"
                :loading="isAllCardTypesLoading"
                clearable
            />

            <q-select
                v-model="currency"
                :options="allCurrencies"
                label="Currency"
                class="w-56"
                :loading="isAllCurrenciesLoading"
                clearable
            />


            <q-btn
                @click="createBankAccount"
                :disable="isProcessing"
                color="primary"
                label="Create Bank Account"
                no-caps
            />
        </q-form>

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
import AppLayout from '@/Layouts/AppLayout.vue';
import BankingLayout from "@/Layouts/BankingLayout.vue";
export default {
    name: 'Dashboard',
    components: {
        BankingLayout,
        AppLayout,
    },
    data(){
        return{
            accountNumber: null,
            sortCode: null,
            isAllBanksLoading: true,
            bank: null,
            allBanks: [],
            allCurrencies: [],
            isAllCurrenciesLoading: true,
            cardType: null,
            currency: null,
            allCardTypes: [],
            isAllCardTypesLoading: true,
            isProcessing: false,
            selectedUsers: [],
            allUsers: [],
            isAllUsersLoading: true,
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
        this.getAllBanks();
        this.getAllCardTypes();
        this.getAllUsers();
        this.getAllPaymentCategories();
        this.getAllCurrencies();
    },
    methods:{
        resetForm(){
            this.selectedUsers = [];
            this.bank = null;
            this.accountNumber = null;
            this.sortCode = null;
            this.cardType = null;
            this.currency = null;
        },
        resetPaymentForm(){
            this.paymentCategory = null;
            this.paymentDate = null;
            this.paymentAmount = null;
            this.paymentDescription = null;
        },
        createBankAccount() {
            this.isProcessing = true;
            axios.post('/api/bank-account/create', {
                'account_number': this.accountNumber,
                'sort_code': this.sortCode,
                'bank_id': this.bank.id,
                'card_type_id': this.cardType.id,
                'currency_id': this.currency.id,
                'user_ids': this.selectedUsers.map(user => user.id),
            })
                .then(() => {
                    this.resetForm();
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isProcessing = false;
                })
        },
        getAllCurrencies(){
            axios.get('/api/currencies')
                .then(response => {
                    this.allCurrencies = response.data.map(currency => ({
                        id: currency.id,
                        label: currency.name
                    }));
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isAllCurrenciesLoading = false;
                });
        },
        getAllBanks() {
            axios.get('/api/banks')
                .then(response => {
                    this.allBanks = response.data.map(bank => ({
                        id: bank.id,
                        label: bank.name
                    }));
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isAllBanksLoading = false;
                })
        },
        getAllCardTypes() {
            axios.get('/api/card-types')
                .then(response => {
                    this.allCardTypes = response.data.map(cardType => ({
                        id: cardType.id,
                        label: cardType.name
                    }));
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isAllCardTypesLoading = false;
                })
        },
        getAllUsers(){
            axios.get('/api/users')
                .then(response => {
                    this.allUsers = response.data.map(user => ({
                        id: user.id,
                        label: user.name
                    }));
                })
                .catch(error => {
                    console.error(error)
                })
                .finally(() => {
                    this.isAllUsersLoading = false;
                })
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
