<template>
   <div>

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
            <transition-group name="fade-blog" tag="div" mode="out-in"> 
                    <div class="col-lg-12" :key="blog.id">
                        <div class="blog-details-inner">
                            <div class="blog-detail-title">
                                <h2>{{blog.blog_title}}</h2>
                                <p>{{blog.category_tag}} <span>- {{blog.created_at}}</span></p>
                            </div>
                            <div class="blog-large-pic">
                                <img :src="this.BLOG_MAIN_IMAGE + blog.blog_main_image" :alt="blog.blog_title">
                            </div>
                            <div class="blog-detail-desc">
                                <p>
                                    {{blog.blog_data_1}}
                                </p>
                            </div>
                            <div class="blog-quote">
                                <p>“{{blog.blog_quote}}” 
                                    <template v-if="blog.blog_quote_author != null">
                                        <span>- {{blog.blog_quote_author}}</span>
                                    </template>
                                    <template v-else>
                                        <span>- Unknown</span>
                                    </template>
                                </p>
                            </div>
                            <div class="blog-more">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img :src="BLOG_SUB_IMAGE_1 + blog.blog_sub_image_1" :alt="blog.blog_title">
                                    </div>
                                    <div class="col-sm-4">
                                        <img :src="BLOG_SUB_IMAGE_2 + blog.blog_sub_image_2" :alt="blog.blog_title">
                                    </div>
                                    <div class="col-sm-4">
                                        <img :src="BLOG_SUB_IMAGE_3 + blog.blog_sub_image_3" :alt="blog.blog_title">
                                    </div>
                                </div>
                            </div>
                            <p>
                                {{blog.blog_data_2}}
                            </p>
                            <div class="tag-share">
                                <div class="details-tag">
                                    <ul>
                                        <li><i class="fa fa-tags"></i></li>
                                        <!-- <template  v-for="tag in blog.category_tag"> -->
                                        <li>{{blog.category_tag}}</li>
                                        <!-- </template> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-post">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <a href="#" class="prev-blog">
                                            <div class="pb-pic">
                                                <i class="ti-arrow-left"></i>
                                                <img :src="this.ROOT_URL + 'img/blog/prev-blog.png'" alt="">
                                            </div>
                                            <div class="pb-text">
                                                <span>Previous Post:</span>
                                                <h5>The Personality Trait That Makes People Happier</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-5 offset-lg-2 col-md-6">
                                        <a href="#" class="next-blog">
                                            <div class="nb-pic">
                                                <img :src="this.ROOT_URL + 'img/blog/next-blog.png'" alt="">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            <div class="nb-text">
                                                <span>Next Post:</span>
                                                <h5>The Personality Trait That Makes People Happier</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="leave-comment">
                                <h4>Leave A Comment</h4>
                                <form class="comment-form" @submit.prevent>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea placeholder="Messages" v-model="commentContent"></textarea>
                                            <button type="submit" class="site-btn" @click="createComment"> Comment </button>
                                            <button class="site-btn" @click="seeComments">View all comments &#8594;</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </transition-group>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    </div>
</template>
<script>
import axios from 'axios'
import { eventBus } from './../../../main'

export default {
    created()
    {
        axios.get(`blogs/${this.id}`)
        .then(response => this.blog = response.data)
        .catch(error => error)
    },

    deactivated()
    {
        this.$destroy();
    },

    data()
    {
        return{
            id: this.$route.params.id,
            blog: "",
            commentContent: "",
        };
    },

    methods:
    {
        createComment()
        {
            let formdata = new FormData();
            formdata.append('comment_data', this.commentContent);
            formdata.append('blog_id', this.id);
            formdata.append('user_id', this.$store.getters.getterUserId);
            axios.post('comments', formdata)
            .then(response => 
            {
                this.seeComments();
            })
            .catch(error => error)
            this.commentContent = "";
        },

        seeComments()
        {
            this.$router.push({name: 'blog-comments', params: {id: this.id}});
        },
    },
}
</script>

<style scoped>
/* Blog Animation */
.fade-blog-enter{
  opacity: 0;
}
.fade-blog-enter-active{
  transition: opacity 1s;
}
.fade-blog-leave-active{
  transition: opacity 1s;
  opacity: 0;
}
</style>
