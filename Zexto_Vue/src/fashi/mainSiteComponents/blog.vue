<template>
<div>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="blog-sidebar">
                        <div class="search-form">
                            <h4>Search</h4>
                            <form action="#">
                                <input type="text" placeholder="Search . . .  ">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="blog-catagory">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Travel</a></li>
                                <li><a href="#">Picnic</a></li>
                                <li><a href="#">Model</a></li>
                            </ul>
                        </div>
                        <div class="recent-post">
                            <h4>Recent Post</h4>
                            <div class="recent-blog">
                            <template v-for="blog in blogs">
                                <router-link :to="{name: 'blog-details', params:{id: blog.id}}" tag="a" class="rb-item">
                                    <div class="rb-pic">
                                        <img :src="BLOG_MAIN_IMAGE + blog.blog_main_image" alt="blog">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{blog.blog_title}}</h6>
                                        <p>{{blog.category_tag}} <span>- {{blog.created_at}}</span></p>
                                    </div>
                                </router-link>
                            </template>
                            </div>
                        </div>
                        <div class="blog-tags">
                            <h4>Product Tags</h4>
                            <div class="tag-item">
                                <a href="#">Towel</a>
                                <a href="#">Shoes</a>
                                <a href="#">Coat</a>
                                <a href="#">Dresses</a>
                                <a href="#">Trousers</a>
                                <a href="#">Men's hats</a>
                                <a href="#">Backpack</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                    
                    <template v-for="blog in blogs">
                        <div class="col-lg-6 col-sm-6">
                            <div class="blog-item">
                                <div class="bi-pic">
                                    <router-link :to="{name: 'blog-details', params:{id: blog.id}}" tag="a">
                                        <img :src="BLOG_MAIN_IMAGE + blog.blog_main_image" alt="blog">
                                    </router-link>
                                </div>
                                <div class="bi-text">
                                    <router-link :to="{name: 'blog-details', params:{id: blog.id}}" tag="a">
                                        <h4>{{blog.blog_title}}</h4>
                                    </router-link>
                                    <p>{{blog.category_tag}}<span>- {{blog.created_at}}</span></p>
                                </div>
                            </div>
                        </div>
                    </template>
                        <div class="col-lg-12">
                            <div class="loading-more">
                                <i class="icon_loading"></i>
                                <a href="#">
                                    Loading More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

</div>
</template>
<script>
import axios from 'axios'

export default {

    created()
    {
        axios.get('blogs')
        .then(response => this.blogs = response.data)
        .catch(error => error)
    },

    data()
    {
        return{
            blogs: "",
        };
    },
}
</script>
