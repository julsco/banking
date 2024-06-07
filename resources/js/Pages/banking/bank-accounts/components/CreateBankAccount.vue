<template>
    <BankingSection>
        <template #title>Create Bank Account</template>
        <template #content>
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
        </template>
    </BankingSection>
</template>

<script>
import BankingSection from "@/Layouts/BankingSection.vue";
export default {
    name: 'BankAccounts',
    components: {
        BankingSection,
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
        }
    },
    created() {
        this.getAllBanks();
        this.getAllCardTypes();
        this.getAllUsers();
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
        createBankAccount() {
            this.isProcessing = true;
            axios.post('/api/bank-accounts/create', {
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
    },
}
</script>
