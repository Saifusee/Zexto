const state = {
    productId: "",
    productName: "",
    productIntroduction: "",
    productFeatures: "",
    productAmount: "",
    productPreviousAmount: "",
    productStock: "",
    productFor: "",
    productMainImage: "",
    productDescriptionImage: "",
    productSubImage1: "",
    productSubImage2: "",
    productSubImage3: "",
    productSubImage4: "",
    productSubImage5: "",
    productSubImage6: "",
    productColors: "",
    productSize: "",
    productWeight: "",
    productTags: "",
    productCategoryTag: "",
    productVendor: "",

}

const getters ={
    getterProductId: state =>
    {
        return state.productId;
    },
    getterProductName: state =>
    {
        return state.productName;
    },
    getterProductIntroduction: state =>
    {
        return state.productIntroduction;
    },
    getterProductFeatures: state =>
    {
        return state.productFeatures;
    },
    getterProductAmount: state =>
    {
        return state.productAmount;
    },
    getterProductPreviousAmount: state =>
    {
        return state.productPreviousAmount;
    },
    getterProductStock: state =>
    {
        return state.productStock;
    },
    getterProductFor: state =>
    {
        return state.productFor;
    },
    getterProductMainImage: state =>
    {
        return state.productMainImage;
    },
    getterProductDescriptionImage: state =>
    {
        return state.productDescriptionImage;
    },
    getterProductSubImage1: state =>
    {
        return state.productSubImage1;
    },
    getterProductSubImage2: state =>
    {
        return state.productSubImage2;
    },
    getterProductSubImage3: state =>
    {
        return state.productSubImage3;
    },
    getterProductSubImage4: state =>
    {
        return state.productSubImage4;
    },
    getterProductSubImage5: state =>
    {
        return state.productSubImage5;
    },
    getterProductSubImage6: state =>
    {
        return state.productSubImage6;
    },
    getterProductColors: state =>
    {
        return state.productColors;
    },
        getterProductSize: state =>
    {
        return state.productSize;
    },
    getterProductWeight: state =>
    {
        return state.productWeight;
    },
    getterProductTags: state =>
    {
        return state.productTags;
    },
    getterProductCategoryTag: state =>
    {
        return state.productCategoryTag;
    },
    getterProductVendor: state =>
    {
        return state.productVendor;
    },
}

const mutations = {
    mutateProductId: (state, payload) =>
    {
        state.productId = payload;
    },
    mutateProductName: (state, payload) =>
    {
        state.productName = payload;
    },
    mutateProductIntroduction: (state, payload) =>
    {
        state.productIntroduction = payload;
    },
    mutateProductFeatures: (state, payload) =>
    {
        state.productFeatures = payload;
    },
    mutateProductAmount: (state, payload) =>
    {
        state.productAmount = payload;
    },
    mutateProductPreviousAmount: (state, payload) =>
    {
        state.productPreviousAmount = payload;
    },
    mutateProductStock: (state, payload) =>
    {
        state.productStock = payload;
    },
    mutateProductFor: (state, payload) =>
    {
        state.productFor = payload;
    },
    mutateProductMainImage: (state, payload) =>
    {
        state.productMainImage = payload;
    },
    mutateProductDescriptionImage: (state, payload) =>
    {
        state.productDescriptionImage = payload;
    },
    mutateProductSubImage1: (state, payload) =>
    {
        state.productSubImage1 = payload;
    },
    mutateProductSubImage2: (state, payload) =>
    {
        state.productSubImage2 = payload;
    },
    mutateProductSubImage3: (state, payload) =>
    {
        state.productSubImage3 = payload;
    },
    mutateProductSubImage4: (state, payload) =>
    {
        state.productSubImage4 = payload;
    },
    mutateProductSubImage5: (state, payload) =>
    {
        state.productSubImage5 = payload;
    },
    mutateProductSubImage6: (state, payload) =>
    {
        state.productSubImage6 = payload;
    },

    mutateProductColors: (state, payload) =>
    {
        state.productColors = payload;
    },
    mutateProductSize: (state, payload) =>
    {
        state.productSize = payload;
    },
    mutateProductWeight: (state, payload) =>
    {
        state.productWeight = payload;
    },
    mutateProductTags: (state, payload) =>
    {
        state.productTags = payload;
    },
    mutateProductCategoryTag: (state, payload) =>
    {
        state.productCategoryTag = payload;
    },
    mutateProductVendor: (state, payload) =>
    {
        state.productVendor = payload;
    },
}

const actions = {
    actionProductId: ({commit}, payload) =>
    {
        commit('mutateProductId', payload);
    },
    actionProductName: ({commit}, payload) =>
    {
        commit('mutateProductName', payload);
    },
    actionProductIntroduction: ({commit}, payload) =>
    {
        commit('mutateProductIntroduction', payload);
    },
    actionProductFeatures: ({commit}, payload) =>
    {
        commit('mutateProductFeatures', payload);
    },
    actionProductAmount: ({commit}, payload) =>
    {
        commit('mutateProductAmount', payload);
    },
    actionProductPreviousAmount: ({commit}, payload) =>
    {
        commit('mutateProductPreviousAmount', payload);
    },
    actionProductStock: ({commit}, payload) =>
    {
        commit('mutateProductStock', payload);
    },
    actionProductFor: ({commit}, payload) =>
    {
        commit('mutateProductFor', payload);
    },
    actionProductMainImage: ({commit}, payload) =>
    {
        commit('mutateProductMainImage', payload);
    },
    actionProductDescriptionImage: ({commit}, payload) =>
    {
        commit('mutateProductDescriptionImage', payload);
    },
    actionProductSubImage1: ({commit}, payload) =>
    {
        commit('mutateProductSubImage1', payload);
    },
    actionProductSubImage2: ({commit}, payload) =>
    {
        commit('mutateProductSubImage2', payload);
    },
    actionProductSubImage3: ({commit}, payload) =>
    {
        commit('mutateProductSubImage3', payload);
    },
    actionProductSubImage4: ({commit}, payload) =>
    {
        commit('mutateProductSubImage4', payload);
    },
    actionProductSubImage5: ({commit}, payload) =>
    {
        commit('mutateProductSubImage5', payload);
    },
    actionProductSubImage6: ({commit}, payload) =>
    {
        commit('mutateProductSubImage6', payload);
    },
    actionProductColors: ({commit}, payload) =>
    {
        commit('mutateProductColors', payload);
    },
    actionProductSize: ({commit}, payload) =>
    {
        commit('mutateProductSize', payload);
    },
    actionProductWeight: ({commit}, payload) =>
    {
        commit('mutateProductWeight', payload);
    },
    actionProductTags: ({commit}, payload) =>
    {
        commit('mutateProductTags', payload);
    },
    actionProductCategoryTag: ({commit}, payload) =>
    {
        commit('mutateProductCategoryTag', payload);
    },
    actionProductVendor: ({commit}, payload) =>
    {
        commit('mutateProductVendor', payload);
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}