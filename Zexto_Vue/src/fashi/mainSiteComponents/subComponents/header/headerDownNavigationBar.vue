<template>
    <div>
                <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                            <li><a href="#">Underwear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand Fashion</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#">Luxury Brands</a></li>
                            <li><a href="#">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a :href="$router.resolve({name: 'home'}).href">Home</a></li>
                        <li><router-link :to="{name: 'shop'}" tag="a">Shop</router-link></li>
                        <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li>
                        <li><router-link :to="{name: 'blog'}" tag="a">Blog</router-link></li>
                        <li><router-link :to="{name: 'contact'}" tag="a">Contact</router-link></li>
                        <li><a style="cursor: pointer">Pages</a>
                            <ul class="dropdown">
                                <li v-if="admin()"><a :href="$router.resolve({name: 'admin-admin-dashboard'}).href">Admin's Dashboard</a></li>
                                <li v-if="vendor()"><a :href="$router.resolve({name: 'admin-dashboard'}).href">Vendors's Dashboard</a></li>
                                <li><router-link :to="{name: 'shopping-cart'}" tag="a">Shopping Cart</router-link></li>
                                <li><router-link :to="{name: 'check-out', params: {id: $store.getters.getterUserId}}" tag="a">Checkout</router-link></li>
                                <li><router-link :to="{name: 'faq'}" tag="a">Faq</router-link></li>
                            </ul>
                        </li> 
                        <li v-if="!isLogin"><a style="cursor: pointer">Public Pages</a>
                            <ul class="dropdown">
                                <template>
                                    <li><router-link :to="{name: 'register'}" tag="a">Register</router-link></li>
                                    <li><router-link :to="{name: 'login'}" tag="a">Login</router-link></li>
                                </template>
                            </ul>
                        </li> 
                        <template v-if="isLogin">
                                <li style="cursor: pointer" @click="logout()"><a><i class="fa fa-user"></i> Logout</a></li>
                        </template>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
        computed:
    {
        ...mapGetters(
            {
                isLogin: 'getterHeaderIsLogin',
                isVendor: 'getterUserIsVendor',
                isAdmin: 'getterUserIsAdmin',
            }
        ),

    },

    methods:
    {
        ...mapActions(
            {
                logout: 'actionHeaderLogout',    
            }
        ),

        vendor: function()
        {
            if(this.isVendor == 1)
            {
                return true;
            } else if (typeof(this.isVendor) === 'undefined' || typeof(this.isVendor) === 'null')
            {
                this.$router.push({name: 'login'});
            }
        },

        admin: function()
        {
            if(this.isAdmin == 1)
            {
                return true;
            } else if (typeof(this.isAdmin) === 'undefined' || typeof(this.isAdmin) === 'null')
            {
                this.$router.push({name: 'login'});
            }
        }
    }
}
</script>