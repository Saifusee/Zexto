<template>
    <div>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a :href="$router.resolve({name: 'home'}).href"><i class="fa fa-home"></i> Home</a>
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
                                <input type="text" id="email" :value="computeEmail" @input="methodEmail($event.target.value)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.email">
                               <ul style="padding:5px" v-for="emailError in registrationErrors.email"><li>{{emailError}}</li></ul>
                            </div>
                            </div>
                            <hr>
                            <div class="form-group form-check form-check-inline">
                                <h5>Profile Picture:</h5>
                                <div style="text-indent:1em">
                                    <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-main-image" ref="file_profile_image" @change="profileImageUpload">
                                </div>
                                <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.profile_picture">
                                    <ul style="padding:5px; margin: 0px; margin: 0px" v-for="imageError in registrationErrors.profile_picture"><li>{{imageError}}</li></ul>
                                </div>
                            </div> <br>
                            <hr>
                            <div class="radio">
                                <h5>User Status *</h5>
                                 <input type="radio" id="status-buyer" name="status" checked value=0>
                                 <label for="Buyer">Buyer</label><br>
                                <input type="radio" id="status-seller" name="status" value=1>
                                 <label for="Buyer">Seller or Vendor</label>
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.status">
                               <ul style="padding:5px" v-for="statusError in registrationErrors.status"><li>{{statusError}}</li></ul>
                            </div>                                 
                            </div> <br> 
                            <hr>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" id="password" :value="computePassword" @input="methodPassword($event.target.value)">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password">
                               <ul style="padding:5px" v-for="passwordError in registrationErrors.password"><li>{{passwordError}}</li></ul>
                            </div>                                
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="password" id="confirm-password">
                            <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password_confirmation">
                               <ul style="padding:5px" v-for="password_confirmationError in registrationErrors.password_confirmation"><li>{{password_confirmationError}}</li></ul>
                            </div>                                
                            </div>
                            <button type="submit" class="site-btn register-btn" @click.keyup.enter="registerButton" >REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <router-link :to="{name: 'login'}" tag="a" class="or-login">Or Login</router-link>
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
import * as constant from './../../constant'
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios'
export default {
    data()
    {
        return {
            registrationErrors: {},
            profilePicture: "",
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
        
        profileImageUpload()
        {
            this.profilePicture = this.$refs.file_profile_image.files[0];
        },

        registerButton()
        {
            let data, radio, selected; 
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
            //setting data to send on api request to create a new user
                data = new FormData(); 
                data.append('username', this.$store.getters.getterRegisterUsername.toLowerCase());
                data.append('email', this.$store.getters.getterRegisterEmail.toLowerCase());
                data.append('firstname', this.$store.getters.getterRegisterFirstname.toUpperCase());
                data.append('lastname', this.$store.getters.getterRegisterLastname.toUpperCase());
                data.append('password', this.$store.getters.getterRegisterPassword);
                data.append('password_confirmation', document.getElementById("confirm-password").value);
                data.append('is_vendor', selected);
                data.append('profile_picture', this.profilePicture);

            //sending post request via axios.
            axios.post("users", data)
            .then(response =>
            {
            //emptying the fields and all errors after succeeding the user creation process.
            this.registrationErrors = "";
            this.methodUsername("");
            this.methodEmail("");
            this.methodPassword(""); 
            document.getElementById("confirm-password").value = ""; 
            window.location = `${this.DOMAIN_FRONTEND}/login`; 
            }) 
            .catch(error =>
            {
            //if there any validation errors first removing all previous errors the on second statement filling with new one.
             this.registrationErrors = "";   
             this.registrationErrors = error.response.data.errors;
             //error alert automatically disappear after 1 minute.
             setTimeout(() => this.registrationErrors = "", constant.TIMEOUT);
            })

        }
    }
}
</script>