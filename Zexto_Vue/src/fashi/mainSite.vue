<template>
<div>
    <!-- Page Preloder -->


    <!-- Header Section Begin -->
    <header class="header-section">

      <fashi-header-top></fashi-header-top>
      <fashi-header-middle></fashi-header-middle>
      <fashi-header-down></fashi-header-down>

    </header>
    <!-- Header End -->

  <component :is="fashiComponent"></component>

    <!-- Partner Logo Section Begin -->
   <fashi-partner-logo></fashi-partner-logo>
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    <fashi-footer-section></fashi-footer-section>
    <!-- Footer Section End -->
</div>
</template>

<script>
import index from "./mainSiteComponents/index.vue";
import blog from "./mainSiteComponents/blog.vue";
import blogDetails from "./mainSiteComponents/blogDetails.vue";
import checkOut from "./mainSiteComponents/checkOut.vue";
import contact from "./mainSiteComponents/contact.vue";
import faq from "./mainSiteComponents/faq.vue";
import main from "./mainSiteComponents/main.vue";
import login from "./mainSiteComponents/login.vue";
import register from "./mainSiteComponents/register.vue";
import shoppingCart from "./mainSiteComponents/shoppingCart.vue";
import shop from "./mainSiteComponents/shop.vue";

import headerTopContact from "./mainSiteComponents/subComponents/header/headerTopContact.vue";
import headerMiddlePanel from "./mainSiteComponents/subComponents/header/headerMiddlePanel.vue";
import headerDownNavigationBar from "./mainSiteComponents/subComponents/header/headerDownNavigationBar.vue";
import footerSection from "./mainSiteComponents/subComponents/footer/footerSection.vue";
import partnerLogo from "./mainSiteComponents/subComponents/footer/partnerLogo.vue";

export default {
  data()
  {
    return {
      fashiComponent: "fashiLogin",
    }
  },

  components: 
  {
    "fashiIndex": index,
    "fashiBlogDetails": blogDetails,
    "fashiBlog": blog,
    "fashiCheckOut": checkOut,
    "fashiFaq": faq,
    "fashiContact": contact,
    "fashiLogin": login,
    "fashiRegister": register,
    "fashiMain": main,
    "fashiShop": shop,
    "fashiShoppingCart": shoppingCart,
    "fashiHeaderTop": headerTopContact,
    "fashiHeaderMiddle": headerMiddlePanel,
    "fashiHeaderDown": headerDownNavigationBar,
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