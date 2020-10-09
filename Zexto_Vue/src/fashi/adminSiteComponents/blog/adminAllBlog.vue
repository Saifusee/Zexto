<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">All Blogs</h3>
              <small>Details of all the blogs of Zexto.</small>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Blog Creator</th>
                      <th>Title</th>
                      <th>Main Image</th>
                      <th>Category Tag</th>
                      <th>Product Tags</th>
                      <th>Status</th>
                      <th>Comments</th>
                      <th>Updated at</th>
                      <th title="Edit Blog">Edit</th>
                      <th title="Change Status of Blog">Change Status</th>
                      <th title="Delete Blog">Delete</th>
                    </tr>
                  </thead>
                  <!-- Using Transition group to add transitions where transition group tag going to replace with tbody in DOM -->
                  <transition-group name="fade-tbody" tag="tbody" mode="out-in"> 
                    <tr class="ttr" v-for="blog in allBlogs" :key="blog.id">
                      <td><router-link tag="a" :to="{name: 'user-profile', params: {id: blog.user_id}}">{{blog.username}}</router-link></td>
                      <td><a :href="$router.resolve({name: 'blog-details', params: {id: blog.id}}).href">{{blog.blog_title}}</a></td>
                      <td><a :href="$router.resolve({name: 'blog-details', params: {id: blog.id}}).href"><img :src="BLOG_MAIN_IMAGE + blog.blog_main_image" width="100px"></a></td>
                      <td>{{blog.category_tag}}</td>
                      <template v-if="blog.product_tags !== ''">
                          <td>{{blog.product_tags}}</td>
                      </template>
                      <template v-else>
                          <td>---No Tags---</td>
                      </template>
                      <template v-if="blog.blog_status == 'Approved'">
                      <td style="color:green">{{blog.blog_status}}</td>
                      </template>
                      <template v-if="blog.blog_status == 'Disapproved'">
                      <td style="color:red">{{blog.blog_status}}</td>
                      </template>
                      <td><router-link tag="a" :to="{name: 'admin-blog-comments', params: {id: blog.id}}">{{ blog.comment_count }}</router-link></td>
                      <td>{{blog.updated_at}}</td>
                      <th class="icon-user" :title="`Edit Blog`"><i class="fa fa-edit" @click="editBlog(blog.id)"></i></th>
                      <td class="icon-user" title="Change Status"><i class="fa fa-circle" @click="blogStatus(blog.id, blog.blog_title)"></i></td>
                      <td class="icon-user" :title="`Delete Blog`"><i class="fa fa-trash" @click="deleteBlog(blog.id, blog.blog_title)"></i></td>
                    </tr>
                </transition-group>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        
      </div>
      <!-- End of Main Content -->
</template>
<script>
import axios from 'axios'
import { mapActions } from 'vuex';
import { eventBus } from './../../../main'


export default {
  data()
  {
    return{
      allBlogs: '',
    };
  },

  created()
  {
    //To show table when component loaded.
    this.blogDetails();

    ///////    Listening to the events from EventBus if user click confirm on Modal   ///////

    //for Delete Blog (we get id from the data on event emitting)
    eventBus.$on('event-admin-allBlog-delete', (id) =>
    {
      let url = `blogs/${id}`
      axios.delete(url)
      .then(response => this.blogDetails())
      .catch(error => error)
    });

    //for changing blog status from approve/disapprove (we get id from the data on event emitting)
    eventBus.$on('event-admin-allBlog-change-status', (id) =>
    {
      let url = `blogs/${id}/status`
      axios.post(url)
      .then(response => this.blogDetails())
      .catch(error => error)  
    });

  },

  computed:
  {

  },

  methods:
  {
    ...mapActions(
      {
        //Getting All modal vuex
        methodModalVisibility: 'actionModalVisibility',
        methodModalTitle: 'actionModalTitle',
        methodModalBody: 'actionModalBody',
        methodModalButton: 'actionModalButton',
        methodModalData: 'actionModalData',
        methodModalSource: 'actionModalSource',

      }
    ),
 

    //Sending request to get all the users.
    blogDetails()
    {
        axios.get('admin/blogs')
        .then(
            response => 
            {
                this.allBlogs = response.data;
            }
        )
    },

    //Call for Modal
    callModal(bool, title, body, button, data, source)
    {
      //All this change make the modal component visible and provide relevant data for modal Structure.
      this.methodModalVisibility(bool);
      this.methodModalTitle(title);
      this.methodModalBody(body);
      this.methodModalButton(button);
      this.methodModalData(data);
      this.methodModalSource(source);
    },

    //Calling Modal for deleting User Account
    deleteBlog(id, blog_title)
    { 
      let title, body, button, source;
      title = `Blog Delete`;
      body = `Are you sure to Delete Blog "${blog_title}"`;
      button = `Delete Account`;
      source = `admin-allBlog-delete`;
      this.callModal(true, title, body, button, id, source);

    },

    //Calling Modal for changing user's vendor status
    blogStatus(id, blog_title)
    {
      let title, body, button, source;
      title = `Change Blog Status`;
      body = `Are you sure to change "${blog_title}" Status`;
      button = `Change`;
      source = `admin-allBlog-change-status`;
      this.callModal(true, title, body, button, id, source);
    },

    editBlog(blogId)
    {
      this.$router.push({name: 'admin-edit-blog', params: { id: blogId }});
    },
  },

}
</script>


<style scoped>
/* Table Animation */
.fade-tbody-enter{
  opacity: 0;
}
.fade-tbody-enter-active{
  transition: opacity 1s;
}
.fade-tbody-leave-active{
  transition: opacity 1s;
  opacity: 0;
}

/* Buttons on Hover */
.icon-user:hover{
  background-color: #c0c0c0;
}
.ttr:hover{
  background-color: #f1f1f1;
}
th, td{
  text-align: center;
}
a{
  text-decoration: none;
  color: grey;
}
a:hover{
  color: black;
}
</style>
