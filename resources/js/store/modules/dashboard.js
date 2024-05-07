const state = {
    bankAccounts: [],
    mainBankAccount: null,
    isUserBankAccountsLoading: true,
};

const actions = {
    async getBankAccountsForUser({ commit, rootState }) {
        commit('setIsUserBankAccountsLoading', true);
        try {
            const userId = rootState.userVariables.user?.id;
            const response = await axios.get(`/api/bank-accounts/${userId}`)
            commit('setBankAccounts', response.data);
            const mainAccount = state.bankAccounts.find(account => account.is_main)
            commit('setMainBankAccount', mainAccount);
        } catch (e) {
            console.error(e)
        } finally {
            commit('setIsUserBankAccountsLoading', false);
        }
    },
};

const mutations = {
    setBankAccounts(state, bankAccounts) {
        state.bankAccounts = bankAccounts;
    },
    setMainBankAccount(state, mainBankAccount) {
        state.mainBankAccount = mainBankAccount;
    },
    setIsUserBankAccountsLoading(state, isUserBankAccountsLoading) {
        state.isUserBankAccountsLoading = isUserBankAccountsLoading;
    },
};
export default {
    namespaced: true,
    state,
    actions,
    mutations,
}
