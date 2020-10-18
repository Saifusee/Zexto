const state = {
    userId: "",
    userUsername: "",
    userEmail: "",
    userFirstname: "",
    userLastname: "",
    userIsAdmin: "",
    userIsVendor: "",
    userEmailVerified: "",
    userCreatedAt: "",
    userUpdatedAt: "",
    userProfilePicture: "",
}

const getters ={
    getterUserId: state =>
    {
        return state.userId;
    },
    getterUserUsername: state =>
    {
        return state.userUsername;
    },
    getterUserEmail: state =>
    {
        return state.userEmail;
    },
    getterUserFirstname: state =>
    {
        return state.userFirstname;
    },
    getterUserLastname: state =>
    {
        return state.userLastname;
    },
    getterUserIsAdmin: state =>
    {
        return state.userIsAdmin;
    },
    getterUserIsVendor: state =>
    {
        return state.userIsVendor;
    },
    getterUserCreatedAt: state =>
    {
        return state.userCreatedAt;
    },
    getterUserUpdatedAt: state =>
    {
        return state.userUpdatedAt;
    },
    getterUserEmailVerified: state =>
    {
        return state.userEmailVerified;
    },
    getterUserProfilePicture: state =>
    {
        return state.userProfilePicture;
    },
}

const mutations = {
    mutateUserDetails: (state, payload) =>
    {
        state.userId = payload.id;
        state.userUsername = payload.username;
        state.userEmail = payload.email;
        state.userFirstname = payload.firstname;
        state.userLastname = payload.lastname;
        state.userIsAdmin = payload.is_admin;
        state.userIsVendor = payload.is_vendor;
        state.userEmailVerified = payload.email_verified,
        state.userCreatedAt = payload.created_at;
        state.userUpdatedAt = payload.updated_at;
        state.userProfilePicture = payload.profile_picture;
    },

}

const actions = {
    actionUserDetails: ({commit}, payload) =>
    {
        commit('mutateUserDetails', payload);
    },

}
export default {
    state,
    getters,
    mutations,
    actions,
}