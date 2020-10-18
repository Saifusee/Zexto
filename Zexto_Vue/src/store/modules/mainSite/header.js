import * as constant from './../../../constant'

const state = {
}

const getters ={
    getterHeaderIsLogin: state =>
    {
        let token = window.localStorage.getItem("token");
        if(typeof token == null)
        {
            return false;
        } else if (token)
        {
            return true;
        }
    },
}

const mutations = {
    mutateHeaderLogout: (state, payload) =>
    {
            window.localStorage.removeItem("token");
            window.location = `${constant.DOMAIN_FRONTEND}login`;
    },
}

const actions = {
    actionHeaderLogout: ({commit}, payload) =>
    {
        commit('mutateHeaderLogout', payload);
    }
}

export default {
    state,
    getters,
    mutations,
    actions,
}