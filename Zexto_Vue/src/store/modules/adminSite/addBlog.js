const state = {
    addBlogTitle: "",
    addBlogData1: "",
    addBlogData2: "",
    addBlogQuote: "",
    addBlogQuoteAuthor: "",
    addBlogCategoryTag: "",
    addBlogProductTags: "",
}

const getters ={
    getterAddBlogTitle: state =>
    {
        return state.addBlogTitle;
    },
    getterAddBlogData1: state =>
    {
        return state.addBlogData1;
    },
    getterAddBlogData2: state =>
    {
        return state.addBlogData2;
    },
    getterAddBlogQuote: state =>
    {
        return state.addBlogQuote;
    },
    getterAddBlogQuoteAuthor: state =>
    {
        return state.addBlogQuoteAuthor;
    },
    getterAddBlogCategoryTag: state =>
    {
        return state.addBlogCategoryTag;
    },
    getterAddBlogProductTags: state =>
    {
        return state.addBlogProductTags;
    },
    getterAddBlogMainImage: state =>
    {
        return state.addBlogMainImage;
    },
    getterAddBlogSubImage1: state =>
    {
        return state.addBlogSubImage1;
    },
    getterAddBlogSubImage2: state =>
    {
        return state.addBlogSubImage2;
    },
    getterAddBlogSubImage3: state =>
    {
        return state.addBlogSubImage3;
    },

}

const mutations = {
    mutateAddBlogTitle: (state, payload) =>
    {
        state.addBlogTitle = payload;
    },
    mutateAddBlogData1: (state, payload) =>
    {
        state.addBlogData1 = payload;
    },
    mutateAddBlogData2: (state, payload) =>
    {
        state.addBlogData2 = payload;
    },
    mutateAddBlogQuote: (state, payload) =>
    {
        state.addBlogQuote = payload;
    },
    mutateAddBlogQuoteAuthor: (state, payload) =>
    {
        state.addBlogQuoteAuthor = payload;
    },
    mutateAddBlogCategoryTag: (state, payload) =>
    {
        state.addBlogCategoryTag = payload;
    },
    mutateAddBlogProductTags: (state, payload) =>
    {
        state.addBlogProductTags = payload;
    },
    mutateAddBlogMainImage: (state, payload) =>
    {
        state.addBlogMainImage = payload;
    },
    mutateAddBlogSubImage1: (state, payload) =>
    {
        state.addBlogSubImage1 = payload;
    },
    mutateAddBlogSubImage2: (state, payload) =>
    {
        state.addBlogSubImage2 = payload;
    },
    mutateAddBlogSubImage3: (state, payload) =>
    {
        state.addBlogSubImage3 = payload;
    },


}

const actions = {
    actionAddBlogTitle: ({commit}, payload) =>
    {
        commit('mutateAddBlogTitle', payload);
    },
    actionAddBlogData1: ({commit}, payload) =>
    {
        commit('mutateAddBlogData1', payload);
    },
    actionAddBlogData2: ({commit}, payload) =>
    {
        commit('mutateAddBlogData2', payload);
    },
    actionAddBlogQuote: ({commit}, payload) =>
    {
        commit('mutateAddBlogQuote', payload);
    },
    actionAddBlogQuoteAuthor: ({commit}, payload) =>
    {
        commit('mutateAddBlogQuoteAuthor', payload);
    },
    actionAddBlogCategoryTag: ({commit}, payload) =>
    {
        commit('mutateAddBlogCategoryTag', payload);
    },
    actionAddBlogProductTags: ({commit}, payload) =>
    {
        commit('mutateAddBlogProductTags', payload);
    },
    actionAddBlogMainImage: ({commit}, payload) =>
    {
        commit('mutateAddBlogMainImage', payload);
    },
    actionAddBlogSubImage1: ({commit}, payload) =>
    {
        commit('mutateAddBlogSubImage1', payload);
    },
    actionAddBlogSubImage2: ({commit}, payload) =>
    {
        commit('mutateAddBlogSubImage2', payload);
    },
    actionAddBlogSubImage3: ({commit}, payload) =>
    {
        commit('mutateAddBlogSubImage3', payload);
    },

}

export default {
    state,
    getters,
    mutations,
    actions,
}