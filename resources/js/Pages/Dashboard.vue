<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

const createBankAccount = () => {
    return axios.post('/api/bank-account/create', {
        'account_number': 123456,
        'sort_code': '12-34-56',
        'bank_id': 7,
        'card_type_id': 1,
        'user_ids': [1],
    }).then(response => console.log(response))
        .catch(error => console.error(error));
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <q-btn @click="createBankAccount" color="primary" label="Primary" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
