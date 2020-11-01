<template>
    <div>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" :href="$router.resolve({name:'home'}).href">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-home"></i>
                    <span>Home &#8594;</span>
                </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <template v-if="admin()">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <router-link :to="{name: 'admin-admin-dashboard'}" class="nav-link" tag="a">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Admin Dashboard</span></router-link>
                </li>
            </template>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Vendors Area
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <router-link :to="{name: 'admin-dashboard'}" class="nav-link" tag="a">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></router-link>
            </li>

            <!-- Nav Item - Blog Details-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Blogs</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{$store.getters.getterUserUsername}}'s Blog Details</h6>
                    <router-link :to="{name: 'admin-user-blog', params: {id: this.$store.getters.getterUserId}}"  tag="a" class="collapse-item">All Blogs</router-link>
                    <router-link :to="{name: 'admin-add-blog'}"  tag="a" class="collapse-item">Add New Blog</router-link>
                </div>
                </div>
            </li>
            <!-- Nav Item - Blog Details-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Products</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{$store.getters.getterUserUsername}}'s Product Details</h6>
                    <router-link :to="{name: 'admin-user-product', params: {id: this.$store.getters.getterUserId}}"  tag="a" class="collapse-item">All Products</router-link>
                    <router-link :to="{name: 'admin-add-product', params: {userId: this.$store.getters.getterUserId}}"  tag="a" class="collapse-item">Add New Product</router-link>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Add Product Taxes</h6>
                    <router-link :to="{name: 'admin-all-tax', params: {id: this.$store.getters.getterUserId}}"  tag="a" class="collapse-item">All Taxes</router-link>
                    <router-link :to="{name: 'admin-add-tax'}"  tag="a" class="collapse-item">Add Taxes</router-link>
                </div>
                </div>
            </li>
        <template v-if="admin()">
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin Zone
            </div>

            <!-- User Details -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                <i class="fas fa-fw fa-folder"></i>
                <span>Users</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Details</h6>
                    <router-link :to="{name: 'admin-all-user'}"  tag="a" class="collapse-item">All Users</router-link>
                    <router-link :to="{name: 'admin-add-user'}"  tag="a" class="collapse-item">Add New User</router-link>

                </div>
                </div>
            </li>

            <!-- Products Details -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseBlogs">
                <i class="fas fa-fw fa-folder"></i>
                <span>Products Details</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingBlogs" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Zexto Products Details</h6>
                    <router-link :to="{name: 'admin-all-product'}"  tag="a" class="collapse-item">All Products</router-link>
                    <router-link :to="{name: 'admin-add-product', params: {userId: this.$store.getters.getterUserId}}"  tag="a" class="collapse-item">Add New Products</router-link>
                </div>
                </div>
            </li>

            <!-- Blogs Details -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true" aria-controls="collapseBlogs">
                <i class="fas fa-fw fa-folder"></i>
                <span>Admin Blogs</span>
                </a>
                <div id="collapseBlogs" class="collapse" aria-labelledby="headingBlogs" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Zexto Blogs Details</h6>
                    <router-link :to="{name: 'admin-all-blog'}"  tag="a" class="collapse-item">All Blogs</router-link>
                    <router-link :to="{name: 'admin-add-blog'}"  tag="a" class="collapse-item">Add New Blog</router-link>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Blog Comments</h6>
                    <router-link :to="{name: 'admin-all-comments'}"  tag="a" class="collapse-item">All Comments</router-link>

                </div>
                </div>
            </li>
        </template>
            <!-- Nav Item - Profile -->
            <li class="nav-item">
                <router-link :to="{name: 'admin-profile', params: {id: this.$store.getters.getterUserId}}" tag="a" class="nav-link">
                <i class="fas fa-fw fa-table"></i>
                <span>Profile</span></router-link>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
         </ul>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    computed:
    {
        ...mapGetters(
            {
                isAdmin: 'getterUserIsAdmin',
            }
        ),
    },

    methods:
    {
        admin()
        {
            if(this.isAdmin === 1)
            {
                return true;
            }else 
            {
                return false;
            }
        }
    },
}
</script>