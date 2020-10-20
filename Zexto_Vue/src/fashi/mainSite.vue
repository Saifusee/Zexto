<template>
  <div>
    <template v-if="this.$router.currentRoute.name !== 'login' && this.$router.currentRoute.name !== 'register' && this.$router.currentRoute.name !== '404'">
        <!-- Header Section Begin -->
        <header class="header-section">

            <!-- <fashi-header-top></fashi-header-top> -->
            <fashi-header-top></fashi-header-top>
            <fashi-header-down></fashi-header-down>

        </header>
        <!-- Header End -->
          <template v-if="checkEmailVerification()">
            <div class="alert alert-danger text-center">
              <p>
                Your e-mail hasn't been verified yet.
              </p>
              <p>
                <button class="btn btn-warning" @click="sendEmail()">Click Here to Send Verification e-mail again.</button>
                <button class="btn btn-warning" @click="changeEmail()">Click Here to Change e-mail.</button>
              </p><br>
              <p v-if="showInputField">
                <input type="email" placeholder="Type your E-mail Here" v-model="emailValue">
                <button class="btn btn-primary btn-sm" @click="submitEmail()">Submit</button>
              </p>
              <p class="alert alert-success" v-if="emailSentSuccessfully">
                Verification email sent successfully.
              </p>
              <p class="alert alert-warning" v-if="emailSentFail">
                Cannot send verification email, please provide valid email id or check your internet connection.
              </p>
            </div>
          </template>
        </template>
    <!-- MainSite child components started. -->
    <keep-alive>
      <router-view></router-view>
    </keep-alive>
    <!-- MainSite child components end. -->
    <template v-if="this.$router.currentRoute.name !== '404'">
      <!-- Partner Logo Section Begin -->
      <fashi-partner-logo></fashi-partner-logo>
      <!-- Partner Logo Section End -->

      <!-- Footer Section Begin -->
      <fashi-footer-section></fashi-footer-section>
      <!-- Footer Section End -->
    </template>
  </div>
</template>

<script>
//Importing Header Components
import headerTopPanel from "./mainSiteComponents/subComponents/header/headerTopPanel.vue";
import headerDownNavigationBar from "./mainSiteComponents/subComponents/header/headerDownNavigationBar.vue";

//Importing Footer Components
import footerSection from "./mainSiteComponents/subComponents/footer/footerSection.vue";
import partnerLogo from "./mainSiteComponents/subComponents/footer/partnerLogo.vue";

//Importing axios
import axios from 'axios'
import { mapGetters } from 'vuex';

export default {
    components: 
    {
      //Header Components
      "fashiHeaderTop": headerTopPanel,
      "fashiHeaderDown": headerDownNavigationBar,

      //Footer Components
      "fashiFooterSection": footerSection,
      "fashiPartnerLogo": partnerLogo,
    },

    created()
  {
      if(window.localStorage.getItem('token') !== undefined)
      {
          axios.post('me')
          .then(response =>
          {
              this.emailVerificationValue = response.data.email_verified;
              this.id = response.data.id;
              this.userEmail = response.data.email;
              //Setting the User Details on user.js of vuex
              this.$store.dispatch('actionUserDetails', response.data);
          })
      }

  },

  data()
  {
    return {
      id: "",
      userEmail: "",
      emailVerificationValue: "",
      emailValue: "",
      emailSentSuccessfully: false,
      emailSentFail: false,
      showInputField: false,
    };
  },

  methods:
  {
    checkEmailVerification()
    {
        if(this.emailVerificationValue === 0)
        {
          return true;
        } else if(this.emailVerificationValue === 1)
        {
          return false
        } else if(typeof(this.emailVerificationValue) === undefined)
        {
          return false;
        }
      },

      changeEmail()
      {
        this.showInputField = true  
      },

      submitEmail()
      {
        let data = {
          'email': this.emailValue,
          'id': this.id,
        };
        axios.post('resend-email', data)
        .then(response => 
        {
          this.emailSentSuccessfully = true;
          this.showInputField = false;
        })
        .error(error => 
        {
          this.emailSentFail = true;
          this.showInputField = false;
        })
      },

      sendEmail()
      {
        let data = {
          'email': this.userEmail,
          'id': this.id,
        };
        axios.post('resend-email', data)
        .then(response => 
        {
          this.emailSentSuccessfully = true;
          this.showInputField = false;
        })
        .error(error => 
        {
          this.emailSentFail = true;
        })
      },
  },

}
</script>

<style scoped>
@import url("http://localhost:8080/src/fashi/css/bootstrap.min.css");
@import url("http://localhost:8080/src/fashi/css/font-awesome.min.css");
@import url("http://localhost:8080/src/fashi/css/themify-icons.css");
@import url("http://localhost:8080/src/fashi/css/elegant-icons.css");
@import url("http://localhost:8080/src/fashi/css/owl.carousel.min.css");
@import url("http://localhost:8080/src/fashi/css/nice-select.css");
@import url("http://localhost:8080/src/fashi/css/jquery-ui.min.css");
@import url("http://localhost:8080/src/fashi/css/slicknav.min.css");
@import url("http://localhost:8080/src/fashi/css/style.css");



a {
  text-decoration: none;
  color: black;
}
a:hover {
  color: white;
}
p {
  margin: 0px;
  padding: 0px;
}
button {
  border: 2px solid black;
}
</style>