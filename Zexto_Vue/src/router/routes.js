import AdminSite from './../fashi/adminSite.vue'
import MainSite from './../fashi/mainSite.vue'
import Home from './../fashi/mainSiteComponents/index.vue'
import BlogDetails from "./../fashi/mainSiteComponents/blogDetails.vue";
export const routes =[
    { path: '/home', component: MainSite, name: 'main-site', children: 
        [
            { path: '', component: Home, name: 'home'},
            { path: '/blogdetails', component: BlogDetails, name: 'blog-details'},
        ]
    },


    { path: '/admin', component: AdminSite, name: 'admin-site'},
];