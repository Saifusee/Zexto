//Main Site component import.
import MainSite from './../fashi/mainSite.vue'
//Admin Site component import.
import AdminSite from './../fashi/adminSite.vue'

//Main Site all Child components import.
import index from "./../fashi/mainSiteComponents/index.vue";
import blog from "./../fashi/mainSiteComponents/blog.vue";
import blogDetails from "./../fashi/mainSiteComponents/blogDetails.vue";
import checkOut from "./../fashi/mainSiteComponents/checkOut.vue";
import contact from "./../fashi/mainSiteComponents/contact.vue";
import faq from "./../fashi/mainSiteComponents/faq.vue";
import main from "./../fashi/mainSiteComponents/main.vue";
import login from "./../fashi/mainSiteComponents/login.vue";
import register from "./../fashi/mainSiteComponents/register.vue";
import shoppingCart from "./../fashi/mainSiteComponents/shoppingCart.vue";
import shop from "./../fashi/mainSiteComponents/shop.vue";

//Admin Site all Child components import.




export const routes =[
    { path: '/admin', component: AdminSite, name: 'admin-site'}, //Route to load Admin Site.



    { path: '*', component: MainSite, children:                  //Route to load Main Site.

        [                                                        //All child components of Main Site.
            { path: '/home', component: index, name: "home"},
            { path: '/blog', component: blog, name: "blog"},
            { path: '/blog-details', component: blogDetails, name: "blog-details"},
            { path: '/check-out', component: checkOut, name: "check-out"},
            { path: '/contact', component: contact, name: "contact"},
            { path: '/faq', component: faq, name: "faq"},
            { path: '/login', component: login, name: "login"},
            { path: '/register', component: register, name: "register"},
            { path: '/shopping-cart', component: shoppingCart, name: "shopping-cart"},
            { path: '/shop', component: shop, name: "shop"},
        ]

    },

];