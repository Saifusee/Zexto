const state = {
    registerUsername: "",
    registerEmail: "",
    registerPassword: "",
}

const getters ={
    getterRegisterUsername: state =>
    {
        return state.registerUsername;
    },
    getterRegisterEmail: state =>
    {
        return state.registerEmail;
    },
    getterRegisterPassword: state =>
    {
        return state.registerPassword;
    },
    getterRegisterButtonDisable: state =>
    {
        return state.buttonDisable;
    }
}

const mutations = {
    mutateRegisterUsername: (state, payload) =>
    {
        state.registerUsername = payload;
    },
    mutateRegisterEmail: (state, payload) =>
    {
        state.registerEmail = payload;
    },
    mutateRegisterPassword: (state, payload) =>
    {
        state.registerPassword = payload;
    },
}

const actions = {
    actionRegisterUsername: ({commit}, payload) =>
    {
        commit('mutateRegisterUsername', payload);
    },
    actionRegisterEmail: ({commit}, payload) =>
    {
        commit('mutateRegisterEmail', payload);
    },
    actionRegisterPassword: ({commit}, payload) =>
    {
        commit('mutateRegisterPassword', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}