const state = {
    registerUsername: "",
    registerEmail: "",
    registerPassword: "",
    registerFirstname: "",
    registerLastname: "",
    registerProfilePicture: "",
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
    getterRegisterFirstname: state =>
    {
        return state.registerFirstname;
    },
    getterRegisterLastname: state =>
    {
        return state.registerLastname;
    },
    getterRegisterProfilePicture: state =>
    {
        return state.registerProfilePicture;
    },
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
    mutateRegisterFirstname: (state, payload) =>
    {
        state.registerFirstname = payload;
    },
    mutateRegisterLastname: (state, payload) =>
    {
        state.registerLastname = payload;
    },
    mutateRegisterProfilePicture: (state, payload) =>
    {
        state.registerProfilePicture = payload;
    }
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
    actionRegisterFirstname: ({commit}, payload) =>
    {
        commit('mutateRegisterFirstname', payload);
    },
    actionRegisterLastname: ({commit}, payload) =>
    {
        commit('mutateRegisterLastname', payload);
    },
    actionRegisterProfilePicture: ({commit}, payload) =>
    {
        commit('mutateRegisterProfilePicture', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}