<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Profile</h3>
              <small>Profile Details of logged in User</small>
            </div>
            <div class="card-body">
                <form @submit.prevent>
                    <div class="form-group" style="text-align:center">
                        <img :src="`${USER_IMAGE}${computeProfilePicture}`" alt="img" width="250px"><br><br>
                    <div class="form-check form-check-inline">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-main-image" ref="file_profile_image" @change="profileImageUpload" v-if="!isEdit">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.profile_picture">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="imageError in registrationErrors.profile_picture"><li>{{imageError}}</li></ul>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Current Username</label>
                        <input type="text" class="form-control" name="username" :disabled="isEdit" :value="computeUsername" @input="methodUsername($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px;" v-if="registrationErrors.username">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="usernameError in registrationErrors.username"><li>{{usernameError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Registered E-mail <span>*</span></label>
                        <input type="text" class="form-control" name="email" :disabled="isEdit" :value="computeEmail" @input="methodEmail($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.email">
                            <ul style="padding:5px; margin: 0px" v-for="emailError in registrationErrors.email"><li>{{emailError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" name="firstname" :disabled="isEdit" :value="computeFirstname" @input="methodFirstname($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.firstname">
                            <ul style="padding:5px; margin: 0px" v-for="firstnameError in registrationErrors.firstname"><li>{{firstnameError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="lastname" :disabled="isEdit" :value="computeLastname" @input="methodLastname($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="registrationErrors.lastname">
                            <ul style="padding:5px; margin: 0px" v-for="lastnameError in registrationErrors.lastname"><li>{{lastnameError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="user-status">Vendor Status: <span>*</span></label><br>
                        <div style="margin-left: 10px">
                        <input type="checkbox" id="is_vendor_edit" :disabled="isEdit" name="vendor"> Is Vendor<br>   
                        </div>   
                    </div>
                    <hr>
                    <button type="submit" class="input-control btn btn-secondary" @click.keyup.enter="registerButton" v-if="!isEdit">Update Profile</button>
                    <button type="submit" class="input-control btn btn-secondary" @click="cancelEdit" v-if="!isEdit">Cancel</button>
                    <button type="submit" class="input-control btn btn-secondary" @click="editProfile" v-if="isEdit">Edit Profile</button>
                </form>
            </div>
          </div>

        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios'
import * as constant from './../../../constant'

export default {
    created()
    {
        let id = this.id;
        axios.get(`users/${id}/edit`)
        .then(response => 
        {
            this.methodUsername(response.data.username);
            this.methodEmail(response.data.email);
            this.methodFirstname(response.data.firstname);
            this.methodLastname(response.data.lastname);
            this.methodProfilePicture(response.data.profile_picture);
            if(response.data.is_vendor === 1)
            {
                document.getElementById("is_vendor_edit").checked = true;
            }
            if(response.data.is_admin === 1)
            {
                document.getElementById("is_admin_edit").checked = true;
            }
        })
        .catch(error => error)
    },

    data()
    {
        return {
            registrationErrors: {},
             /*We are taking here id from route params not from user vuex bcz on refresh this
              data lost but not param so we past user id from vuex on profile button route and take that value here*/
            id: this.$route.params.id,
            localProfilePicture: "",
            edit: true,
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
                computeProfilePicture: 'getterRegisterProfilePicture',
            }),

            isEdit()
            {
                return this.edit;
            }
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
                methodProfilePicture: 'actionRegisterProfilePicture',
            }
        ),
        
        profileImageUpload()
        {
            this.localProfilePicture = this.$refs.file_profile_image.files[0];
        },

        registerButton()
        {
            let data, vendorSelected, adminSelected, vendorValue, adminValue;
            //Getting the checkboxes.
            vendorSelected = document.getElementById("is_vendor_edit");
            adminSelected = document.getElementById("is_admin_edit");
            //Checking if the checkboxes are checked and assigning values from them.
                if(vendorSelected.checked)
                {
                    vendorValue = 1;
                }else
                {
                    vendorValue = 0;
                }
            //setting data to send on api request to create a new user
                data = new FormData();
                data.append('id', this.id);
                data.append('username', this.$store.getters.getterRegisterUsername.toLowerCase());
                data.append('email', this.$store.getters.getterRegisterEmail.toLowerCase());
                data.append('firstname', this.$store.getters.getterRegisterFirstname.toUpperCase());
                data.append('lastname', this.$store.getters.getterRegisterLastname.toUpperCase());
                data.append('is_vendor', vendorValue);
                data.append('profile_picture', this.localProfilePicture);

            //Since html don't understand the put request we need to hack a little bit and add this to our data.
                data.append('_method', 'put');
            //sending post request via axios.
            axios.post(`users/${this.id}`, data)
            .then(response =>
            {
            //emptying the fields and all errors after succeeding the user creation process.
            this.registrationErrors = {};
            this.methodUsername("");
            this.methodEmail("");
            this.methodPassword(""); 
            this.methodProfilePicture(""); 
            this.$router.go({name: 'admin-profile'});
            }) 
            .catch(error =>
            {
            //if there any validation errors first removing all previous errors the on second statement filling with new one.
             this.registrationErrors = {};   
             this.registrationErrors = error.response.data.errors;
             //error alert automatically disappear after 1 minute.
             setTimeout(() => this.registrationErrors = {}, constant.TIMEOUT);
            })

        },

        editProfile()
        {
            this.edit = false;
        },

        cancelEdit()
        {
            this.registrationErrors = {};
            this.edit = true;
        }
    }
}
</script>
<style scoped>
span 
{
    color: #ffcccb;
}
img{
    border-radius: 20%;
}
</style>