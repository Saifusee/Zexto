<template>
    <div>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form @submit.prevent>
                            <div class="alert alert-danger" v-if="loginErrors">
                                <ul v-if="loginErrors.usernameOrEmail" v-for="usernameOrEmailLoginError in loginErrors.usernameOrEmail">
                                    <li>{{usernameOrEmailLoginError}}</li>
                                </ul>
                                <ul v-if="loginErrors.password" v-for="passwordLoginError in loginErrors.password">
                                    <li>{{passwordLoginError}}</li>
                                </ul>
                            </div>
                            <div class="group-input">
                                <label for="username">Username or email address *</label>
                                <input type="text" id="username" :value="computeUsernameOrEmail" @input="methodUsernameOrEmail($event.target.value)">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="pass" :value="computePassword" @input="methodPassword($event.target.value)">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn" @click.keyup.enter.prevent="loginButton" >Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./register.html" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    </div>
</template>
<script>
import axios from 'axios';
import { mapActions, mapGetters } from 'vuex';
export default {
    data()
    {
        return {
            loginErrors: '',
        };
    },

    computed:
    {
        ...mapGetters(
            {
                computeUsernameOrEmail: 'getterLoginUsername',
                computePassword: 'getterLoginPassword',
            }),

    },

    methods:
    {
        ...mapActions(
            {
                methodUsernameOrEmail: 'actionLoginUsername',
                methodPassword: 'actionLoginPassword',
            }),

            loginButton()
            {
                let data;
                data =
                {
                    usernameOrEmail: this.$store.getters.getterLoginUsername,
                    password: this.$store.getters.getterLoginPassword 

                }
                
                axios.post('login', data)
                .then(response => 
                {
                    this.loginErrors = "";
                    this.methodUsernameOrEmail("");
                    this.methodPassword("");
                    window.localStorage.setItem("token", response.data.access_token);
                    this.$router.push('/blog-details');
                })
                .catch(error =>
                {
                    this.loginErrors = {};
                    this.loginErrors = error.response.data.errors;
                    console.log(this.loginErrors);
                })
            }

    },
}
</script>