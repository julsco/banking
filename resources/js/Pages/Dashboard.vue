<template>
    <AppLayout title="Dashboard">
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


            <q-btn
                @click="createBankAccount"
                :disable="isProcessing"
                color="primary"
                label="Create Bank Account"
                no-caps
            />
        </q-form>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    name: 'Dashboard',
    components: {
        AppLayout,
    },
    data(){
        return{
            accountNumber: null,
            sortCode: null,
            isAllBanksLoading: true,
            bank: null,
            allBanks: [],
            cardType: null,
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
    },
    methods:{
        resetForm(){
            this.selectedUsers = [];
            this.bank = null;
            this.accountNumber = null;
            this.sortCode = null;
            this.cardType = null;
        },
        createBankAccount() {
            this.isProcessing = true;
            axios.post('/api/bank-account/create', {
                'account_number': this.accountNumber,
                'sort_code': this.sortCode,
                'bank_id': this.bank.id,
                'card_type_id': this.cardType.id,
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
