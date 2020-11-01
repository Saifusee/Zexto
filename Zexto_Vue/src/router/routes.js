//Importing the Javascript files, Plugins and Packages to use.
import axios from 'axios';
import * as constant from './../constant'

//Importing the MainSite and AdminSite Components to load on router-view of App.vue.
import MainSite from './../fashi/mainSite.vue'
import AdminSite from './../fashi/adminSite.vue'

//Importing all the child components of MainSite to load on router-view of mainSite.vue.
import login from "./../fashi/mainSiteComponents/login.vue"
import register from "./../fashi/mainSiteComponents/register.vue"
import blog from "./../fashi/mainSiteComponents/blog.vue"
import blogDetails from "./../fashi/mainSiteComponents/blog/blogDetails.vue"
import blogComments from "./../fashi/mainSiteComponents/blog/comments.vue"
import checkOut from "./../fashi/mainSiteComponents/checkOut.vue"
import contact from "./../fashi/mainSiteComponents/contact.vue"
import faq from "./../fashi/mainSiteComponents/faq.vue"
import main from "./../fashi/mainSiteComponents/main.vue"
import shoppingCart from "./../fashi/mainSiteComponents/shoppingCart.vue"
import shop from "./../fashi/mainSiteComponents/shop.vue"
import index from "./../fashi/mainSiteComponents/index.vue"
import notFound from "./../fashi/mainSiteComponents/404.vue"
import emailVerified from './../fashi/mainSiteComponents/emailVerified.vue'

//Importing all the child components of AdminSite to load on router-view of adminSite.vue.
import vendorDashboard from "./../fashi/adminSiteComponents/dashboard/vendorDashboard.vue"
import adminDashboard from "./../fashi/adminSiteComponents/dashboard/adminDashboard.vue"
import adminAllUser from "./../fashi/adminSiteComponents/user/adminAllUser.vue"
import adminTry from "./../fashi/adminSiteComponents/user/try.vue"
import adminAddUser from "./../fashi/adminSiteComponents/user/adminAddUser.vue"
import adminEditUser from "./../fashi/adminSiteComponents/user/adminEditUser.vue"
import adminAllBlog from "./../fashi/adminSiteComponents/blog/adminAllBlog.vue"
import adminAddBlog from "./../fashi/adminSiteComponents/blog/adminAddBlog.vue"
import adminEditBlog from "./../fashi/adminSiteComponents/blog/adminEditBlog.vue"
import adminUserBlog from "./../fashi/adminSiteComponents/blog/adminUserBlog.vue"
import adminBlogComments from "./../fashi/adminSiteComponents/blog/adminBlogComments.vue"
import adminVendorBlogComments from "./../fashi/adminSiteComponents/blog/adminVendorBlogComments.vue"
import adminUserComments from "./../fashi/adminSiteComponents/blog/adminUserComments.vue"
import adminAllComments from "./../fashi/adminSiteComponents/blog/adminAllComments.vue"
import adminProfile from "./../fashi/adminSiteComponents/profile/adminProfile.vue"
import userProfile from "./../fashi/adminSiteComponents/profile/userProfile.vue"
import adminAllProduct from "./../fashi/adminSiteComponents/product/adminAllProduct.vue"
import adminUserProduct from "./../fashi/adminSiteComponents/product/adminUserProduct.vue"
import adminAddProduct from "./../fashi/adminSiteComponents/product/adminAddProduct.vue"
import adminEditProduct from "./../fashi/adminSiteComponents/product/adminEditProduct.vue"
import adminAllTax from "./../fashi/adminSiteComponents/product/adminAllTax.vue"
import adminAddTax from "./../fashi/adminSiteComponents/product/adminAddTax.vue"
import adminEditTax from "./../fashi/adminSiteComponents/product/adminEditTax.vue"


export const routes = [
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////     Route to load Admin Site.       ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/admin', component: AdminSite, name: "admin", beforeEnter: (to, from, next) =>
        {
            axios.post('me').then(resposne => 
                {
                    if(resposne.data.is_admin === 1 && resposne.data.email_verified === 1)
                    {
                        next();
                    } else 
                    {
                        window.location = `${constant.DOMAIN_FRONTEND}`;
                    }
                })
        },
        children:
        [
            { path: ':id/user/profile', component: userProfile, name: 'user-profile'},  //Show individual user profile.
            { path: 'user/all', component: adminAllUser, name: "admin-all-user"},  //Show table of all users of site.
            { path: 'user/add-user', component: adminAddUser, name: "admin-add-user"},  //Show the add blog page.
            { path: 'user/:id/edit', component: adminEditUser, name: "admin-edit-user"},  //Show the edit page of user.
            { path: 'blog/all', component: adminAllBlog, name: "admin-all-blog"},  //Show the table of all the blogs on site.
            { path: 'comments/all', component: adminAllComments, name: "admin-all-comments"}, //Show all the comments on all blogs in site.
            { path: 'blog/:id/comments', component: adminBlogComments, name: "admin-blog-comments"},  //Show all the comments on particular blog to admin.
            { path: 'blog/:id/user/comments', component: adminUserComments, name: "admin-user-comments"},   //Show all the comments by a particular user.
            { path: 'product/all', component: adminAllProduct, name: "admin-all-product"}, //show admin dashboard.
            { path: 'admin-dashboard', component: adminDashboard, name: "admin-admin-dashboard"}, //show admin dashboard.
            { path: 'try', component: adminTry, name: "try"}, //show admin dashboard.

        ]
    }, 



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////     Route to load Vendor Site.       ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
{ path: '/vendor', component: AdminSite, name: "vendor", beforeEnter: (to, from, next) =>
{
    axios.post('me').then(resposne => 
    {
        if(resposne.data.is_vendor === 1 && resposne.data.email_verified === 1)
        {
            next();
        } else 
        {
            window.location = `${constant.DOMAIN_FRONTEND}`;
        }
    })
},
children:
[
    { path: ':id/profile', component: adminProfile, name: "admin-profile"},  //Show Logged in user profile.
    { path: 'blog/add-blog', component: adminAddBlog, name: "admin-add-blog"},  //Show the add blog page.
    { path: 'blog/:id/edit', component: adminEditBlog, name: "admin-edit-blog"},  //Show edit blog page.
    { path: 'blog/user/:id', component: adminUserBlog, name: "admin-user-blog"},  //Show all blogs by Logged in user
    { path: 'blog/:id/comments', component: adminVendorBlogComments, name: "admin-user-blog-comments"},  //Show all the comments on particular blog to admin.
    { path: 'product/user/:id', component: adminUserProduct, name: "admin-user-product"}, //show admin dashboard.
    { path: 'product/:userId/add-product', component: adminAddProduct, name: "admin-add-product"},  //Add new products
    { path: ':userId/product/:id/edit', component: adminEditProduct, name: "admin-edit-product"},  //Show edit blog page.
    { path: 'product/tax/all/:id', component: adminAllTax, name: "admin-all-tax"},  //Show all the taxes.
    { path: 'product/tax/add', component: adminAddTax, name: "admin-add-tax"},  //Show the add taxes page.
    { path: 'product/tax/:id/edit', component: adminEditTax, name: "admin-edit-tax"},  //Show the add taxes page.
    { path: 'dashboard', component: vendorDashboard, name: "admin-dashboard"},  // Admin Dashboard
    

]
}, 



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////     Route to load Main Site.       ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    //Load Main Site.
    { path: '/', component: MainSite, children: 

        //All children of main site components.
        [      
            //Putting before enter vue router guard to check if already login no need to go to Login and Register Page.                                                  
            { path: 'login', component: login, name: "login", beforeEnter: (to, from, next) =>
            {
                if(window.localStorage.getItem('token') != undefined)
                {
                    next('/');
                } else 
                {
                    next();
                }
            }},
            { path: 'register', component: register, name: "register", beforeEnter: (to, from, next) =>
            {
                if(window.localStorage.getItem('token') != undefined)
                {
                    next('/');
                } else 
                {
                    next();
                }
            }},
            //Others Path.
            { path: 'blog', component: blog, name: "blog"},
            { path: 'blog-details/:id', component: blogDetails, name: "blog-details"},
            { path: 'blog-comments/:id', component: blogComments, name: "blog-comments"},
            { path: 'check-out/:id', component: checkOut, name: "check-out"},
            { path: 'contact', component: contact, name: "contact"},
            { path: 'faq', component: faq, name: "faq"},
            { path: 'shopping-cart', component: shoppingCart, name: "shopping-cart"},
            { path: 'shop', component: shop, name: "shop"},
            { path: '', component: index, name: "home"},
            { path: 'verify-email/:token/verify/:id', component: emailVerified, name: "email-verified", beforeEnter: (to, from, next) =>
            {
                axios.post('me').then(resposne => 
                    {
                        if(resposne.data.email_verified === 0)
                        {
                            next();
                        } else 
                        {
                            window.location = `${constant.DOMAIN_FRONTEND}`;
                        }
                    })
            }},
            { path: '*', component: notFound, name: "404"},
        ]

    },

];