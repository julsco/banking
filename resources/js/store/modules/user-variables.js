const state = {
    user: null,
    currentTeam: null,
};

const mutations = {
    setCurrentTeam(state, currentTeam) {
        state.currentTeam = currentTeam;
    },
    setUser(state, user) {
        state.user = user;
    },
};
export default {
    namespaced: true,
    state,
    mutations,
}
