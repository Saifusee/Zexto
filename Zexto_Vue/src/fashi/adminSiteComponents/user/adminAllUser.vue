<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">All Users</h3>
              <small>Details of all the users of Zexto.</small>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Profile Picture</th>
                      <th>Username</th>
                      <th>E-mail</th>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>User Status</th>
                      <th>Account created at</th>
                      <th title="Edit User Details">Edit</th>
                      <th title="Vendor Status">Vendor</th>
                      <th title="Admin Status">Admin</th>
                      <th title="Delete User">Delete</th>
                    </tr>
                  </thead>
                  <!-- Using Transition group to add transitions where transition group tag going to replace with tbody in DOM -->
                  <transition-group name="fade-tbody" tag="tbody" mode="out-in"> 
                    <tr class="ttr" v-for="user in allUsers" :key="user.id">
                      <td>
                        <router-link tag="a" :to="{name: 'user-profile', params: {id: user.id}}">
                            <img :src="`${USER_IMAGE}thumb/${user.profile_picture}`" :alt="user.username" width="75px">
                        </router-link>
                      </td>
                      <td><router-link tag="a" :to="{name: 'user-profile', params: {id: user.id}}">{{user.username}}</router-link></td>
                      <td><router-link tag="a" :to="{name: 'user-profile', params: {id: user.id}}">{{user.email}}</router-link></td>
                      <template v-if="user.firstname == null">
                        <td>---Not Given---</td>
                      </template>
                      <template v-else>
                      <td><router-link tag="a" :to="{name: 'user-profile', params: {id: user.id}}">{{user.firstname}}</router-link></td>
                      </template>
                      <template v-if="user.lastname == null">
                        <td>---Not Given---</td>
                      </template>
                      <template v-else>
                      <td><router-link tag="a" :to="{name: 'user-profile', params: {id: user.id}}">{{user.lastname}}</router-link></td>
                      </template>
                      <template v-if="user.is_vendor === 1">
                            <template v-if="user.is_admin === 1">
                                <td> <i>Admin</i></td>
                            </template>
                            <template v-else>
                                <td> <i>Vendor</i></td>
                            </template>
                      </template>
                      <template v-else>
                          <td> <i>User</i></td>
                      </template>
                      <td>{{user.created_at}}</td>
                      <th class="icon-user" :title="`Edit ${user.username} Details`"><i class="fa fa-edit" @click="editUser(user.id)"></i></th>
                      <td class="icon-user" title="Change user status to Buyer or Seller"><i class="fa fa-users" @click="vendorStatusPopUp(user.id, user.username)"></i></td>
                      <td class="icon-user" title="Change user status to Admin or not"><i class="fa fa-user-circle" @click="adminStatusPopUp(user.id, user.username)"></i></td>
                      <td class="icon-user" :title="`Delete User ${user.username}`"><i class="fa fa-trash" @click="deletePopUp(user.id, user.username)"></i></td>
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
      allUsers: {},
    };
  },

  created()
  {
    //To show table when component loaded.
    this.usersDetails();

    ///////    Listening to the events from EventBus if user click confirm on Modal   ///////

    //for Delete User Account (we get id from the data on event emitting)
    eventBus.$on('event-admin-allUser-delete', (id) =>
    {
      let loginUserId = this.$store.getters.getterUserId;
      if(loginUserId === id)
      {
        alert('You cannot delete logged in user data from here.');
        return;
      }
      let url = `users/${id}`
      axios.delete(url)
      .then(response => this.usersDetails())
      .catch(error => error)
    });

    //for changing user status from vendor/user (we get id from the data on event emitting)
    eventBus.$on('event-admin-allUser-change-vendorStatus', (id) =>
    {
      let url = `users/${id}/ven`
      axios.post(url)
      .then(response => this.usersDetails())
      .catch(error => error)  
    });

     //for changing user status from admin/user (we get id from the data on event emitting)
    eventBus.$on('event-admin-allUser-change-adminStatus', (id) =>
    {
      let url = `users/${id}/adm`
      axios.post(url)
      .then(response => this.usersDetails())
      .catch(error => error)  
    });


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
    usersDetails()
    {
        axios.get('users')
        .then(
            response => 
            {
                this.allUsers = response.data;
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
    deletePopUp(id, username)
    { 
      let title, body, button, source;
      title = `User Account Delete`;
      body = `Are you sure to Delete ${username}'s Account`;
      button = `Delete Account`;
      source = `admin-allUser-delete`;
      this.callModal(true, title, body, button, id, source);

    },

    //Calling Modal for changing user's vendor status
    vendorStatusPopUp(id, username)
    {
      let title, body, button, source;
      title = `Change User Vendor Status`;
      body = `Are you sure to change ${username}'s User Status`;
      button = `Change`;
      source = `admin-allUser-change-vendorStatus`;
      this.callModal(true, title, body, button, id, source);
    },

    //Calling Modal for changing user's admin status
    adminStatusPopUp(id, username)
    {
      let title, body, button, source;
      title = `Change User Admin Status`;
      body = `Are you sure to change ${username}'s User Status`;
      button = `Change`;
      source = `admin-allUser-change-adminStatus`;
      this.callModal(true, title, body, button, id, source);
    },

    editUser(userId)
    {
      this.$router.push({name: 'admin-edit-user', params: { id: userId }});
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
a{
  text-decoration: none;
  color: grey;
}
a:hover{
  color: black;
}
th, td{
  text-align: center;
}
</style>
