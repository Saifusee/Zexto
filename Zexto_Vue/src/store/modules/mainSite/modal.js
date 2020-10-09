const state = {
    modalVisibility: false,
    modalTitle: "",
    modalBody: "",
    modalButton: "",
    modalData: "",
    modalSource: "",
}

const getters ={
    getterModalVisibility: state =>
    {
        return state.modalVisibility;
    },
    getterModalTitle: state =>
    {
        return state.modalTitle;
    },
    getterModalBody: state =>
    {
        return state.modalBody;
    },
    getterModalButton: state =>
    {
        return state.modalButton;
    },
    getterModalData: state =>
    {
        return state.modalData;
    },
    getterModalSource: state =>
    {
        return state.modalSource;
    },
}

const mutations = {
    mutateModalVisibility: (state, payload) =>
    {
        state.modalVisibility = payload;
    },
    mutateModalTitle: (state, payload) =>
    {
        state.modalTitle = payload;
    },
    mutateModalBody: (state, payload) =>
    {
        state.modalBody = payload;
    },
    mutateModalButton: (state, payload) =>
    {
        state.modalButton = payload;
    },
    mutateModalData: (state, payload) =>
    {
        state.modalData = payload;
    },
    mutateModalSource: (state, payload) =>
    {
        state.modalSource = payload;
    },
}

const actions = {
    actionModalVisibility: ({commit}, payload) =>
    {
        commit('mutateModalVisibility', payload);
    },
    actionModalTitle: ({commit}, payload) =>
    {
        commit('mutateModalTitle', payload);
    },
    actionModalBody: ({commit}, payload) =>
    {
        commit('mutateModalBody', payload);
    },
    actionModalButton: ({commit}, payload) =>
    {
        commit('mutateModalButton', payload);
    },
    actionModalData: ({commit}, payload) =>
    {
        commit('mutateModalData', payload);
    },
    actionModalSource: ({commit}, payload) =>
    {
        commit('mutateModalSource', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}