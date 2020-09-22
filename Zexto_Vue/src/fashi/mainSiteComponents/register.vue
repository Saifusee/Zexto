<template>
    <div>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
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
                    <div class="register-form">
                        <h2>Register</h2>
                        <form @submit.prevent>
                            <div class="group-input">
                                <label for="username">Username *</label>
                                <input type="text" id="username" :value="computeUsername" @input="methodUsername($event.target.value)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.username">
                               <ul style="padding:5px" v-for="usernameError in registrationErrors.username"><li>{{usernameError}}</li></ul>
                            </div>
                            </div>

                            <div class="group-input">
                                <label for="email">E-Mail *</label>
                                <input type="email" id="email" :value="computeEmail" @input="methodEmail($event.target.value)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.email">
                               <ul style="padding:5px" v-for="emailError in registrationErrors.email"><li>{{emailError}}</li></ul>
                            </div>
                            </div>

                            <div class="radio">
                                <h5>User Status *</h5>
                                 <input type="radio" id="status-buyer" name="status" checked value=0>
                                 <label for="Buyer">Buyer</label><br>
                                <input type="radio" id="status-seller" name="status" value=1>
                                 <label for="Buyer">Seller or Vendor</label>
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.status">
                               <ul style="padding:5px" v-for="statusError in registrationErrors.status"><li>{{statusError}}</li></ul>
                            </div>                                 
                            </div>   <br>                            
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="password" :value="computePassword" @input="methodPassword($event.target.value)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password">
                               <ul style="padding:5px" v-for="passwordError in registrationErrors.password"><li>{{passwordError}}</li></ul>
                            </div>                                
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="password" id="confirm-password" @input="confirmPasswordValidity($event)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password_confirmation">
                               <ul style="padding:5px" v-for="password_confirmationError in registrationErrors.password_confirmation"><li>{{password_confirmationError}}</li></ul>
                            </div>                                
                            </div>
                            <button type="submit" class="site-btn register-btn" @click.keyup.enter="registerButton" >REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="./login.html" class="or-login">Or Login</a>
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
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios'
export default {
    data()
    {
        return {
            registrationErrors: {},
        };
    },
    computed: 
    {
        ...mapGetters(
            {
                computeUsername: 'getterRegisterUsername',
                computeEmail: 'getterRegisterEmail',
                computePassword: 'getterRegisterPassword',
            }),
    },

    methods:
    {
        ...mapActions(
            {
                methodUsername: 'actionRegisterUsername',
                methodEmail: 'actionRegisterEmail',
                methodPassword: 'actionRegisterPassword',
            }
        ),
        
        registerButton()
        {
            let radio, selected; 
            //selecting value of radio buttons by name on register page---Both radio button element get selected with same name.
            radio = document.getElementsByName("status");
            for (let element of radio)
            {
                if(element.checked)
                {
                    selected = element.value;
                    break;
                }
            }
            
            //setting data to send on api request to create a new user
            let data = 
            {
                username: this.$store.getters.getterRegisterUsername,
                email: this.$store.getters.getterRegisterEmail,
                password: this.$store.getters.getterRegisterPassword,
                password_confirmation: document.getElementById("confirm-password").value,
                is_vendor: selected,
            }
            //sending post request via axios.
            axios.post("register", data)
            .then(response =>
            {
            //emptying the fields and all errors after succeeding the user creation process.
            this.registrationErrors = {};
            this.methodUsername("");
            this.methodEmail("");
            this.methodPassword(""); 
            document.getElementById("confirm-password").value = "";  
            }) 
            .catch(error =>
            {
            //if there any validation errors first removing all previous errors the on second statement filling with new one.
             this.registrationErrors = {};   
             this.registrationErrors = error.response.data.errors;
             //error alert automatically disappear after 1 minute.
             setTimeout(() => this.registrationErrors = {}, 60000);
            })

        }
    }
}
</script>