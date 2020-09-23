<template>
  <div>

    <!-- Checking if its a login and register page component loading not show any header components, it looks bad. -->
    <template v-if="publicPage != '/login' && publicPage != '/register'">
        <!-- Header Section Begin -->
        <header class="header-section">

            <fashi-header-top></fashi-header-top>
            <fashi-header-middle></fashi-header-middle>
            <fashi-header-down></fashi-header-down>

        </header>
        <!-- Header End -->
    </template>

    <!-- MainSite child components started. -->
    <router-view></router-view>
    <!-- MainSite child components end. -->

    <!-- Partner Logo Section Begin -->
    <fashi-partner-logo></fashi-partner-logo>
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    <fashi-footer-section></fashi-footer-section>
    <!-- Footer Section End -->
    
  </div>
</template>

<script>
//Importing Header Components
import headerTopContact from "./mainSiteComponents/subComponents/header/headerTopContact.vue";
import headerMiddlePanel from "./mainSiteComponents/subComponents/header/headerMiddlePanel.vue";
import headerDownNavigationBar from "./mainSiteComponents/subComponents/header/headerDownNavigationBar.vue";

//Importing Footer Components
import footerSection from "./mainSiteComponents/subComponents/footer/footerSection.vue";
import partnerLogo from "./mainSiteComponents/subComponents/footer/partnerLogo.vue";

export default {
  data()
  {
    return {
      publicPage: "",
    }
  },

  created()
  {
    //Checking if there's '/login' or '/register' in URL window.location.pathname give us value of URI in URL.
    this.publicPage = window.location.pathname;
  },

  components: 
  {
    //Header Components
    "fashiHeaderTop": headerTopContact,
    "fashiHeaderMiddle": headerMiddlePanel,
    "fashiHeaderDown": headerDownNavigationBar,

    //Footer Components
    "fashiFooterSection": footerSection,
    "fashiPartnerLogo": partnerLogo,
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