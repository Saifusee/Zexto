<template>
    <div>
      <div id="page-top">
                    
          <!-- Page Wrapper -->
          <div id="wrapper">

            <!-- Sidebar -->
              <admin-sidebar></admin-sidebar> 
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

              <!-- Main Content -->
              <div id="content">

                <!-- Topbar -->
                    <admin-topbar></admin-topbar>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                  <router-view></router-view>
                <!-- /.container-fluid -->

              </div>
              <!-- End of Main Content -->

              <!-- Footer -->
                <admin-footer></admin-footer>
              <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

          </div>
          <!-- End of Page Wrapper -->

          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>
      </div>
   </div>
</template>
<script>
//Importing Admin Sidebar contains all list of operations.
import sidebar from './adminSiteComponents/subComponents/sidebar.vue'
//Importing Admin Topbar contains search and Profile.
import topbar from './adminSiteComponents/subComponents/topbar.vue'
//Importing Admin Footer which contains just copyrights.
import adminFooter from './adminSiteComponents/subComponents/adminFooter.vue'

//Importing axios
import axios from 'axios'


export default {
  components:
  {
    'adminSidebar': sidebar,
    'adminTopbar': topbar, 
    'adminFooter': adminFooter, 
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
@import url("http://localhost:8080/src/fashi/adminSiteComponents/files/css/sb-admin-2.min.css");
@import url("http://localhost:8080/src/fashi/adminSiteComponents/files/vendor/fontawesome-free/css/all.min.css");
</style>