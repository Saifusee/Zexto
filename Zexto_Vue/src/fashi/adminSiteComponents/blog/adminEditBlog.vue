<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Edit Blog</h3>
              <small>Details of blog, click Update when you done.</small>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" @submit.prevent>
                    <div class="form-group">
                        <label for="username"><strong>Blog Title</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="blog-title" :value="computeBlogTitle" @input="methodBlogTitle($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_title">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="titleError in creationErrors.blog_title"><li>{{titleError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote-data-1"><strong>Paragraph above Quote</strong> <span>*</span></label>
                        <textarea class="form-control" rows="5" @input="methodBlogData1($event.target.value)">{{computeBlogData1}} </textarea>
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_data_1">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="data1Error in creationErrors.blog_data_1"><li>{{data1Error}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote-data-2"><strong>Paragraph below Quote</strong></label>
                        <textarea class="form-control" rows="5" @input="methodBlogData2($event.target.value)">{{computeBlogData2}} </textarea>
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_data_2">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="data2Error in creationErrors.blog_data_2"><li>{{data2Error}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                    <strong>Blog Main Image:</strong><span>*</span>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-main-image" ref="file_main_image" @change="mainImageUpload">
                        </div>
                        <!-- <img :src="IMAGES + computeBlogMainImage" width="200px"> -->
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_main_image">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="mainImageError in creationErrors.blog_main_image"><li>{{mainImageError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote"><strong>Blog's Quote</strong> </label>
                        <input type="text" class="form-control" name="quote" :value="computeBlogQuote" @input="methodBlogQuote($event.target.value)" placeholder="Write Quote you wanted to include in your blog.">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_quote">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="quoteError in creationErrors.blog_quote"><li>{{quoteError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote-author"><strong>Blog's Quote Author Name</strong></label>
                        <input type="text" class="form-control" name="quote-author" :value="computeBlogQuoteAuthor" @input="methodBlogQuoteAuthor($event.target.value)" placeholder="Write name of Author of the Quote you included.">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.blog_quote_author">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="quoteAuthorError in creationErrors.blog_quote_author"><li>{{quoteAuthorError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                    <strong>Blog Content Image 1:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-sub-image-1" ref="file_sub_image1" @change="subImage1Upload">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Blog Content Image 3:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-sub-image-1" ref="file_sub_image3" @change="subImage3Upload">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Blog Content Image 2:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="blog-sub-image-1" ref="file_sub_image2" @change="subImage2Upload">
                        </div>
                    </div>
                    <br><br>
                    <!-- <div style="text-align: center">
                        <div class="form-check form-check-inline" style="font-size:12px">
                               <img :src="IMAGES + computeBlogSubImage1" width="200px"> 
                        </div>
                        <div class="form-check form-check-inline" style="font-size:12px">
                               <img :src="IMAGES + computeBlogSubImage2" width="200px"> 
                        </div>
                        <div class="form-check form-check-inline" style="font-size:12px">
                               <img :src="IMAGES + computeBlogSubImage3" width="200px">     
                        </div>
                    </div> -->
                    <div style="text-align: center">
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.blog_sub_image_1">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage1Error in creationErrors.blog_sub_image_1"><li>{{subImage1Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.blog_sub_image_2">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage2Error in creationErrors.blog_sub_image_2"><li>{{subImage2Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.blog_sub_image_3">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage3Error in creationErrors.blog_sub_image_3"><li>{{subImage3Error}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="category-tag"><strong>Category Tag</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="category-tag" :value="computeBlogCategoryTag" @input="methodBlogCategoryTag($event.target.value)" placeholder="Select Category under which this blog belongs to.">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.category_tag">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="categoryError in creationErrors.category_tag"><li>{{categoryError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product-tags"><strong>Product Tags</strong></label>
                        <input type="text" class="form-control" name="product-tags" :value="computeBlogProductTags" @input="methodBlogProductTags($event.target.value)" placeholder="Type Product Tags which are related to this Blog">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_tags">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="productError in creationErrors.product_tags"><li>{{productError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="form-control btn btn-secondary" @click.keyup.enter="submitBlog">Update Blog</button>
                </form>
            </div>
          </div>

        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import axios from 'axios'
export default {

    created()
    {
        let id = this.id;
        axios.get(`blogs/${id}/edit`)
        .then(response => 
        {
               this.methodBlogTitle(response.data.blog_title);
               this.methodBlogData1(response.data.blog_data_1);
               this.methodBlogData2(response.data.blog_data_2);
               this.methodBlogQuote(response.data.blog_quote);
               this.methodBlogQuoteAuthor(response.data.blog_quote_author);
               this.methodBlogCategoryTag(response.data.category_tag);
               this.methodBlogProductTags(response.data.product_tags);
               this.methodBlogMainImage(response.data.blog_main_image);
               this.methodBlogSubImage1(response.data.blog_sub_image_1);
               this.methodBlogSubImage2(response.data.blog_sub_image_2);
               this.methodBlogSubImage3(response.data.blog_sub_image_3);
        })
        .catch(error => error)
    },

    data()
    {
        return {
            //Local data for uploaded image files
            id: this.$route.params.id,
            mainImage: '',
            subImage1: '',
            subImage2: '',
            subImage3: '',
            creationErrors: '',
        }
    },

    computed:
    {
        ...mapGetters(
            {
               computeBlogTitle: 'getterAddBlogTitle',
               computeBlogData1: 'getterAddBlogData1',
               computeBlogData2: 'getterAddBlogData2',
               computeBlogQuote: 'getterAddBlogQuote',
               computeBlogQuoteAuthor: 'getterAddBlogQuoteAuthor',
               computeBlogCategoryTag: 'getterAddBlogCategoryTag',
               computeBlogProductTags: 'getterAddBlogProductTags',
               computeBlogMainImage: 'getterAddBlogMainImage',
               computeBlogSubImage1: 'getterAddBlogSubImage1',
               computeBlogSubImage2: 'getterAddBlogSubImage2',
               computeBlogSubImage3: 'getterAddBlogSubImage3',
            }
        ),
    },

    methods:
    {
        ...mapActions(
            {
               methodBlogTitle: 'actionAddBlogTitle',
               methodBlogData1: 'actionAddBlogData1',
               methodBlogData2: 'actionAddBlogData2',
               methodBlogQuote: 'actionAddBlogQuote',
               methodBlogQuoteAuthor: 'actionAddBlogQuoteAuthor',
               methodBlogCategoryTag: 'actionAddBlogCategoryTag',
               methodBlogProductTags: 'actionAddBlogProductTags',
               methodBlogMainImage: 'actionAddBlogMainImage',
               methodBlogSubImage1: 'actionAddBlogSubImage1',
               methodBlogSubImage2: 'actionAddBlogSubImage2',
               methodBlogSubImage3: 'actionAddBlogSubImage3',
            }
        ),

        mainImageUpload()
        {
            this.mainImage = this.$refs.file_main_image.files[0];
        },

        subImage1Upload()
        {
            this.subImage1 = this.$refs.file_sub_image1.files[0];

        },
        subImage2Upload()
        {
            this.subImage2 = this.$refs.file_sub_image2.files[0];

        },
        subImage3Upload()
        {
            this.subImage3 = this.$refs.file_sub_image3.files[0];

        },

        submitBlog()
        {
            let formdata = new FormData();
            formdata.append('id', this.id);
            formdata.append('blog_title', this.computeBlogTitle);
            formdata.append('blog_data_1', this.computeBlogData1);
            formdata.append('blog_data_2', this.$store.getters.getterAddBlogData2);
            formdata.append('blog_quote', this.computeBlogQuote);
            formdata.append('blog_quote_author', this.computeBlogQuoteAuthor);
            formdata.append('category_tag', this.computeBlogCategoryTag);
            formdata.append('product_tags', this.computeBlogProductTags);
            formdata.append('user_id', this.$store.getters.getterUserId);
            formdata.append('blog_main_image', this.mainImage);
            formdata.append('blog_sub_image_1', this.subImage1);
            formdata.append('blog_sub_image_2', this.subImage2);
            formdata.append('blog_sub_image_3', this.subImage3);
            formdata.append('_method', 'put');

            axios.post(`blogs/${this.id}`, formdata)
            .then(response => 
            {
                this.creationErrors = {};
                this.methodBlogTitle("");
                this.methodBlogData1("");
                this.methodBlogData2("");
                this.methodBlogQuote("");
                this.methodBlogQuoteAuthor("");
                this.methodBlogCategoryTag("");
                this.methodBlogProductTags("");
                this.$router.push({name: 'admin-all-blog'});
            })
            .catch(error => 
            {
                this.creationErrors = {};
                this.creationErrors = error.response.data.errors;
                setTimeout(() => this.creationErrors = "", 60000);
            })
        },
    },
}
</script>

<style scoped>
span 
{
    color: #ffcccb;
}
</style>