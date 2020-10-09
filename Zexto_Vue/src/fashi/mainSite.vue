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
            //Setting the User Details on user.js of vuex
            this.$store.dispatch('actionUserDetails', response.data);


        })
    }

}
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
</style>