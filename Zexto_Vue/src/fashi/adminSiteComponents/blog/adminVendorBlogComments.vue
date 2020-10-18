<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Comments on Blog "{{title}}"</h3>
              <small style="color:black">Note: Approved Comments by Admin only display and then later approve and disappove by blog creator.</small>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <v-client-table :data="rows" :columns="columns" :options="options">
                     <!-- For Comment creator -->
                      <template slot="user" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.user.id}}">{{row.user.username}}</router-link>
                      </template>
                     <!-- For Comment blog -->
                      <template slot="blog" slot-scope="{row}">
                          <a :href="$router.resolve({name: 'blog-details', params: {id: row.blog.id}}).href">{{row.blog.blog_title}}</a>
                      </template>
                     <!-- For User Approval -->
                      <template slot="comment_status" slot-scope="{row}">
                          <template v-if="row.comment_status == 'Approved'">
                              <span style="color:green">{{row.comment_status}}</span>
                          </template>
                          <template v-if="row.comment_status == 'Disapproved'">
                              <span style="color:red">{{row.comment_status}}</span>
                          </template>                      
                      </template>
                     <!-- For Admin Approval -->
                      <template slot="comment_admin_status" slot-scope="{row}">
                          <template v-if="row.comment_admin_status == 'Admin-Approved'">
                              <span style="color:green">{{row.comment_admin_status}}</span>
                          </template>
                          <template v-if="row.comment_admin_status == 'Admin-Disapproved'">
                              <span style="color:red">{{row.comment_admin_status}}</span>
                          </template>                     
                      </template>
                     <!-- For Vendor Approval Button -->
                      <template slot="vendor_status_approval" slot-scope="{row}">
                          <i class="fa fa-edit" title="Change Vendor Approval Status" @click="commentStatus(row.id, row.user.username)"></i>
                      </template>
                     <!-- For Delete Button -->
                      <template slot="delete" slot-scope="{row}">
                          <i class="fa fa-trash" :title="`Delete Comment`" @click="deleteComment(row.id, row.user.username)"></i>
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
import { eventBus } from './../../../main';

export default {
  data()
  {
    return{
      id: this.$route.params.id,

      title: "",

      columns: ['user', 'blog', 'comment_data', 'comment_status', 'comment_admin_status', 'created_at', 'vendor_status_approval', 'delete',],

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
        filterable: ['user', 'blog', 'comment_data', 'comment_status', 'comment_admin_status', 'created_at',],
        pagination: { chunk: 10, dropdown: false },
        headings: {
            user: 'Comment By',
            blog: 'Blog Title',
            comment_data: 'Comment',
            comment_status: 'Vendor Approval Status',
            comment_admin_status: 'Admin Approval Status',
            created_at: 'Created at',
            vendor_status_approval: 'Vendor Approval',
            delete: 'Delete',
        },
        columnsDropdown: true,
        filterAlgorithm: {
          //Filter all Vendor Approval Status comments
          comment_status(row, query){
            return (row.comment_status).includes(query);
          },
          //Filter all Admin Approval Status comments
          comment_admin_status(row, query){
            return (row.comment_admin_status).includes(query);
          }
        },
      }
    };
  },

  created()
  {
    //To show table when component loaded.
    this.commentDetails();

    ///////    Listening to the events from EventBus if user click confirm on Modal   ///////

    //for Delete Blog (we get id from the data on event emitting)
    eventBus.$on('event-admin-allComment-delete', (id) =>
    {
      let url = `comments/${id}`
      axios.delete(url)
      .then(response => this.commentDetails())
      .catch(error => error)
    });

    //for changing blog status from approve/disapprove (we get id from the data on event emitting)
    eventBus.$on('event-admin-allComment-change-status', (id) =>
    {
      let url = `comments/${id}/status`
      axios.post(url)
      .then(response => this.commentDetails())
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
 

    //Sending request to get all the comments on particular blog.
    commentDetails()
    {
      //id is blog id
        axios.get(`comments/${this.id}/blog/comments`)
        .then(
            response => 
            {
                this.rows = response.data;
                this.title = response.data[0].blog.blog_title;
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
    deleteComment(id, commentUser)
    { 
      let title, body, button, source;
      title = `Blog Delete`;
      body = `Are you sure to Delete Comment by ${commentUser}`;
      button = `Delete Comment`;
      source = `admin-allComment-delete`;
      this.callModal(true, title, body, button, id, source);

    },

    //Calling Modal for changing user's vendor status
    commentStatus(id, commentUser)
    {
      let title, body, button, source;
      title = `Change Blog Status`;
      body = `Are you sure to change ${commentUser}'s Comment Status`;
      button = `Change`;
      source = `admin-allComment-change-status`;
      this.callModal(true, title, body, button, id, source);
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
