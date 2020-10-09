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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Blog</th>
                      <th>Comment By</th>
                      <th>Comment</th>
                      <th>Vendor Status</th>
                      <th>Admin Status</th>
                      <th>Created At</th>
                      <th title="Change Status of Blog">Vendor Approval</th>
                      <th title="Change Status of Blog">Admin Approval</th>
                      <th title="Delete Blog">Delete</th>
                    </tr>
                  </thead>
                  <!-- Using Transition group to add transitions where transition group tag going to replace with tbody in DOM -->
                  <transition-group name="fade-tbody" tag="tbody" mode="out-in"> 
                    <tr class="ttr" v-for="comment in allComments" :key="comment.id">
                        <td>
                          <a :href="$router.resolve({name: 'blog-details', params: {id: comment.blog.id}}).href">
                            {{comment.blog.blog_title}}
                          </a>
                        </td>
                        <td>
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: comment.user.id}}">
                             {{comment.user.username}}
                          </router-link>
                        </td>
                        <td>{{comment.comment_data}}</td>
                        <template v-if="comment.comment_status == 'Approved'">
                        <td style="color:green">{{comment.comment_status}}</td>
                        </template>
                        <template v-if="comment.comment_status == 'Disapproved'">
                        <td style="color:red">{{comment.comment_status}}</td>
                        </template>
                        <template v-if="comment.comment_admin_status == 'Admin-Approved'">
                        <td style="color:green">{{comment.comment_admin_status}}</td>
                        </template>
                        <template v-if="comment.comment_admin_status == 'Admin-Disapproved'">
                        <td style="color:red">{{comment.comment_admin_status}}</td>
                        </template>                       
                        <td>{{comment.created_at}}</td>
                        <td class="icon-user" title="Change Status"><i class="fa fa-edit" @click="commentStatus(comment.id, comment.user.username)"></i></td>
                        <td class="icon-user" title="Change Status"><i class="fa fa-user" @click="commentAdminStatus(comment.id, comment.user.username)"></i></td>
                        <td class="icon-user" :title="`Delete Blog`"><i class="fa fa-trash" @click="deleteComment(comment.id, comment.user.username)"></i></td>
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
import { eventBus } from './../../../main';

export default {
  data()
  {
    return{
        id: this.$route.params.id,
        allComments: '',
        title: "",
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

    //for changing blog status from approve/disapprove (we get id from the data on event emitting)
    eventBus.$on('event-admin-allComment-change-admin-status', (id) =>
    {
      let url = `comments/${id}/status/admin`
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
                this.allComments = response.data;
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

    //Calling Modal for changing user's admin approval status
    commentAdminStatus(id, commentUser)
    {
      let title, body, button, source;
      title = `Change Comments Admin Approval Status`;
      body = `Are you sure to change ${commentUser}'s Comment Admin Approval Status`;
      button = `Change`;
      source = `admin-allComment-change-admin-status`;
      this.callModal(true, title, body, button, id, source);
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
