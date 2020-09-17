<template>
<div>
   <component :is="siteInUse"></component>
</div>
</template>

<script>
import mainSite from "./fashi/mainSite.vue";
import adminSite from "./fashi/adminSite.vue";

export default {
  data()
  {
    return {
      siteInUse: "fashiMainSite",
    }
  },

  components: 
  {
    "fashiMainSite": mainSite,
    "fashiAdminSite": adminSite,
  }
}
</script>
