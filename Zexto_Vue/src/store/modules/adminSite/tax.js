const state = {
    taxId: "",
    taxName: "",
    taxDescription: "",
    taxPercentage: "",
    taxUser: "",


}

const getters ={
    getterTaxId: state =>
    {
        return state.taxId;
    },
    getterTaxName: state =>
    {
        return state.taxName;
    },
    getterTaxDescription: state =>
    {
        return state.taxDescription;
    },
    getterTaxPercentage: state =>
    {
        return state.taxPercentage;
    },
    getterTaxUser: state =>
    {
        return state.taxUser;
    },
}

const mutations = {
    mutateTaxId: (state, payload) =>
    {
        state.taxId = payload;
    },
    mutateTaxName: (state, payload) =>
    {
        state.taxName = payload;
    },
    mutateTaxDescription: (state, payload) =>
    {
        state.taxDescription = payload;
    },
    mutateTaxPercentage: (state, payload) =>
    {
        state.taxPercentage = payload;
    },
    mutateTaxUser: (state, payload) =>
    {
        state.taxUser = payload;
    },
}

const actions = {
    actionTaxId: ({commit}, payload) =>
    {
        commit('mutateTaxId', payload);
    },
    actionTaxName: ({commit}, payload) =>
    {
        commit('mutateTaxName', payload);
    },
    actionTaxDescription: ({commit}, payload) =>
    {
        commit('mutateTaxDescription', payload);
    },
    actionTaxPercentage: ({commit}, payload) =>
    {
        commit('mutateTaxPercentage', payload);
    },
    actionTaxUser: ({commit}, payload) =>
    {
        commit('mutateTaxUser', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}