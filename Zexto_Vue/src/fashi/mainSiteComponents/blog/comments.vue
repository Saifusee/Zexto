<template>
    <div>
        <section class="blog-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details-inner">
                            <div v-if="comments[0] == undefined">
                                <h2>No comments to show....</h2>
                            </div>
                            <div class="posted-by" style="padding-bottom: 50px" v-else v-for="comment in comments">
                                <div class="pb-pic">
                                    <img :src="`${USER_IMAGE}thumb/${comment.user.profile_picture}`" :alt="comment.user.profile_picture" width="60px" style="border-radius:50%;">
                                </div>
                                <div class="pb-text">
                                        <h5>{{comment.user.username}}</h5><small id="time"> -{{comment.created_at}}</small>
                                    <p>
                                        {{comment.comment_data}}
                                    </p>
                                </div>
                            </div>
                            <div class="leave-comment">
                                <h4>Leave Comment</h4>
                                <form class="comment-form" @submit.prevent>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea placeholder="Messages" v-model="commentContent"></textarea>
                                            <button type="submit" class="site-btn" @click="createComment"> Comment </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import axios from 'axios'
import { eventBus } from './../../../main'

export default {
    created()
    {
        this.commentsRefresh();
    },

    deactivated()
    {
        this.$destroy();
    },

    data()
    {
        return{
            id: this.$route.params.id,
            comments: "",
            commentContent: "",
            ifComments: false,
        };
    },

    methods:
    {
        commentsRefresh()
        {
            axios.get(`comments/${this.id}`)
            .then(response => 
            {
                this.comments = response.data;
                this.ifComments = true;
            })
            .catch(error => error)
        },

        createComment()
        {
            let formdata = new FormData();
            formdata.append('comment_data', this.commentContent);
            formdata.append('blog_id', this.id);
            formdata.append('user_id', this.$store.getters.getterUserId);
            axios.post('comments', formdata)
            .then(response => this.commentsRefresh())
            .catch(error => error)
            this.commentContent = "";
        },
    }
}
</script>
<style scoped>
#time {
    color: grey;
}
</style>