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

                  <v-client-table :data="rows" :columns="columns" :options="options">
                     <!-- For Blog creator -->
                      <template slot="username" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.user_id}}">{{row.username}}</router-link>
                      </template>
                     <!-- For Blog title -->
                      <template slot="blog_title" slot-scope="{row}">
                          <a :href="$router.resolve({name: 'blog-details', params: {id: row.id}}).href">{{row.blog_title}}</a>
                      </template>
                     <!-- For Blog title -->
                      <template slot="blog_main_image" slot-scope="{row}">
                          <a :href="$router.resolve({name: 'blog-details', params: {id: row.id}}).href"><img :src="BLOG_MAIN_IMAGE + row.blog_main_image" width="100px" style="border-radius: 75%"></a>
                      </template>
                     <!-- For Product Tags -->
                      <template slot="product_tags" slot-scope="{row}">
                          <template v-if="row.product_tags !== ''">
                              {{row.product_tags}}
                          </template>
                          <template v-else>
                              ---No Tags---
                          </template>
                      </template>
                    <!-- For Blog Status -->
                      <template slot="blog_status" slot-scope="{row}">
                          <template v-if="row.blog_status == 'Approved'">
                          <span style="color:green">{{row.blog_status}}</span>
                          </template>
                          <template v-if="row.blog_status == 'Disapproved'">
                          <span style="color:red">{{row.blog_status}}</span>
                          </template>
                      </template>
                    <!-- For Comment Count -->
                      <template slot="comment_count" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'admin-blog-comments', params: {id: row.id}}">{{ row.comment_count }}</router-link>
                      </template>
                    <!-- For Edit Button -->
                      <template slot="edit" slot-scope="{row}">
                          <i class="fa fa-edit" :title="`Edit Blog`" @click="editBlog(row.id)"></i>
                      </template>
                    <!-- For Change Status Button -->
                      <template slot="change_status" slot-scope="{row}">
                          <i class="fa fa-circle" title="Change Blog Status" @click="blogStatus(row.id, row.blog_title)"></i>
                      </template>
                    <!-- For Delete Button -->
                      <template slot="delete" slot-scope="{row}">
                          <i class="fa fa-trash" :title="`Delete Blog`" @click="deleteBlog(row.id, row.blog_title)"></i>
                      </template>
                  </v-client-table>

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
      columns: ['username', 'blog_title', 'blog_main_image', 'category_tag', 'product_tags', 'blog_status', 'comment_count', 'created_at', 'updated_at', 'change_status', 'edit', 'delete'],

      rows: [], 

      options: {
        filterByColumn: true, 
        perPage: 10,
        texts: {
          loadingError: 'Oops, Something went wrong.',
          filter: "Search",
          filterBy: '{column}',
          count: ''
        },
        filterable: ['username', 'blog_title', 'blog_main_image', 'category_tag', 'product_tags', 'blog_status', 'comment_count', 'created_at', 'updated_at',],
        pagination: { chunk: 10, dropdown: false },
        headings: {
            username: 'Blog Creator',
            blog_title: 'Blog Title',
            blog_main_image: 'Main Image',
            category_tag: 'Category Tag',
            product_tags: 'Product Tags',
            blog_status: 'Status',
            comment_count: 'Comments',
            updated_at: 'Updated At',
            edit: 'Edit Blog',
            change_status: 'Change Status',
            delete: 'Delete',
        },
        columnsDropdown: true,
        filterAlgorithm: {
          //Filter all Vendor Approval Status comments
          blog_status(row, query){
            return (row.blog_status).includes(query);
          },
        },
      }
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
                this.rows = response.data;
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
/* Buttons on Hover */
a{
  text-decoration: none;
  color: grey;
}
a:hover{
  color: black;
}

.VueTables {
  text-align: center;
}
.VueTables__error {
  color: red;
}
</style>
