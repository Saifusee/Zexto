const state = {
    loginUsername: "",
    loginPassword: "",
}

const getters ={
    getterLoginUsername: state =>
    {
        return state.loginUsername;
    },
    getterLoginPassword: state =>
    {
        return state.loginPassword;
    },
}

const mutations = {
    mutateLoginUsername: (state, payload) =>
    {
        state.loginUsername = payload;
    },
    mutateLoginPassword: (state, payload) =>
    {
        state.loginPassword = payload;
    },
}

const actions = {
    actionLoginUsername: ({commit}, payload) =>
    {
        commit('mutateLoginUsername', payload);
    },
    actionLoginPassword: ({commit}, payload) =>
    {
        commit('mutateLoginPassword', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}