<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Add User</h3>
              <small>Add a new user to Zexto</small>
            </div>
            <div class="card-body">
                <form @submit.prevent>
                    <div class="form-group">
                        <label for="username">Username <span>*</span></label>
                        <input type="text" class="form-control" name="username" :value="computeUsername" @input="methodUsername($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px;" v-if="registrationErrors.username">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="usernameError in registrationErrors.username"><li>{{usernameError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail <span>*</span></label>
                        <input type="text" class="form-control" name="email" :value="computeEmail" @input="methodEmail($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.email">
                            <ul style="padding:5px; margin: 0px" v-for="emailError in registrationErrors.email"><li>{{emailError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                    <strong>Profile Picture:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-main-image" ref="file_profile_image" @change="profileImageUpload">
                        </div>
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.profile_picture">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="imageError in registrationErrors.profile_picture"><li>{{imageError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" name="firstname" :value="computeFirstname" @input="methodFirstname($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.firstname">
                            <ul style="padding:5px; margin: 0px" v-for="firstnameError in registrationErrors.firstname"><li>{{firstnameError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="lastname" :value="computeLastname" @input="methodLastname($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.lastname">
                            <ul style="padding:5px; margin: 0px" v-for="lastnameError in registrationErrors.lastname"><li>{{lastnameError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="user-status">User Status: <span>*</span></label><br>
                        <div style="margin-left: 10px">
                        <input type="checkbox" id="is_vendor" name="vendor"> Is Vendor<br>   
                        <input type="checkbox" id="is_admin" name="admin"> Is Admin
                        </div>   
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="password">Password <span>*</span></label>
                        <input type="password" class="form-control" name="password" :value="computePassword" @input="methodPassword($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password">
                            <ul style="padding:5px; margin: 0px" v-for="passwordError in registrationErrors.password"><li>{{passwordError}}</li></ul>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Cofirm Password <span>*</span></label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.password_confirmation">
                            <ul style="padding:5px; margin: 0px" v-for="password_confirmationError in registrationErrors.password_confirmation"><li>{{password_confirmationError}}</li></ul>
                        </div>  
                    </div>
                    <hr>
                    <button type="submit" class="form-control btn btn-secondary" @click.keyup.enter="registerButton" >REGISTER</button>
                </form>
            </div>
          </div>

        </div>
    </div>
</template>
<script>
import * as constant from './../../../constant'
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios'
export default {

    created()
    {
        this.methodFirstname("");
        this.methodLastname("");
        this.methodUsername("");
        this.methodEmail("");
        this.methodPassword("");
    },

    data()
    {
        return {
            profilePicture: "",
            registrationErrors: "",
        };
    },
    computed: 
    {
        ...mapGetters(
            {
                computeUsername: 'getterRegisterUsername',
                computeEmail: 'getterRegisterEmail',
                computePassword: 'getterRegisterPassword',
                computeFirstname: 'getterRegisterFirstname',
                computeLastname: 'getterRegisterLastname',
            }),
    },

    methods:
    {
        ...mapActions(
            {
                methodUsername: 'actionRegisterUsername',
                methodEmail: 'actionRegisterEmail',
                methodPassword: 'actionRegisterPassword',
                methodFirstname: 'actionRegisterFirstname',
                methodLastname: 'actionRegisterLastname',
            }
        ),
        
        profileImageUpload()
        {
            this.profilePicture = this.$refs.file_profile_image.files[0];
        },

        registerButton()
        {
            let data, vendorSelected, adminSelected, vendorValue, adminValue;
            //Getting the checkboxes.
            vendorSelected = document.getElementById("is_vendor");
            adminSelected = document.getElementById("is_admin");
            //Checking if the checkboxes are checked and assigning values from them.
                if(vendorSelected.checked)
                {
                    vendorValue = 1;
                }else
                {
                    vendorValue = 0;
                }
                if(adminSelected.checked)
                {
                    adminValue = 1;
                }else
                {
                    adminValue = 0;
                }
            //setting data to send on api request to create a new user
                data = new FormData(); 
                data.append('username', this.$store.getters.getterRegisterUsername.toLowerCase());
                data.append('email', this.$store.getters.getterRegisterEmail.toLowerCase());
                data.append('firstname', this.$store.getters.getterRegisterFirstname.toUpperCase());
                data.append('lastname', this.$store.getters.getterRegisterLastname.toUpperCase());
                data.append('password', this.$store.getters.getterRegisterPassword);
                data.append('password_confirmation', document.getElementById("confirm-password").value);
                data.append('is_vendor', vendorValue);
                data.append('is_admin', adminValue);
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
            this.$router.push({name: 'admin-all-user'});
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
<style scoped>
span 
{
    color: #ffcccb;
}
</style>