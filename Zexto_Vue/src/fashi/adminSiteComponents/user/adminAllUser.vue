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
                  <v-client-table :data="rows" :columns="columns" :options="options">

                  <!-- For Profile Picture in each row. -->
                      <template slot="profile_picture" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">
                              <img :src="`${USER_IMAGE}thumb/${row.profile_picture}`" :alt="row.username" width="75px" style="border-radius: 75%">
                          </router-link> 
                      </template>
                  <!-- For Username in each row. -->
                      <template slot="username" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">{{row.username}}</router-link>
                      </template>
                  <!-- For Email in each row. -->
                      <template slot="email" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">{{row.email}}</router-link>
                      </template>
                  <!-- For Firstname in each row. -->
                      <template slot="firstname" slot-scope="{row}">
                          <template v-if="row.firstname == null">
                             ---Not Given---
                          </template>
                          <template v-else>
                            <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">{{row.firstname}}</router-link>
                          </template>                      
                      </template>
                  <!-- For Firstname in each row. -->
                      <template slot="lastname" slot-scope="{row}">
                          <template v-if="row.lastname == null">
                             ---Not Given---
                          </template>
                          <template v-else>
                            <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">{{row.lastname}}</router-link>
                          </template>                      
                      </template>
                  <!-- For User Status Display in each row. -->
                     <template slot="user_status" slot-scope="{row}">
                              <template v-if="row.is_vendor === 1">
                                    <template v-if="row.is_admin === 1">
                                        <i>Admin</i>
                                    </template>
                                    <template v-else>
                                        <i>Vendor</i>
                                    </template>
                              </template>
                              <template v-else>
                                  <i>User</i>
                              </template>
                     </template>
                  <!-- For Vendor Status Button in each row. -->
                      <template slot="vendor_status" slot-scope="{row}">
                          <i class="fa fa-users" @click="vendorStatusPopUp(row.id, row.username)"></i>
                      </template>
                  <!-- For Admin Status Button in each row. -->
                      <template slot="admin_status" slot-scope="{row}">
                          <i class="fa fa-user-circle" @click="adminStatusPopUp(row.id, row.username)"></i>
                      </template>
                  <!-- For Edit Button in each row. -->
                      <template slot="edit" slot-scope="{row}">
                          <i class="fa fa-edit" @click="editUser(row.id)"></i>
                      </template>
                  <!-- For Delete Button in each row. -->
                      <template slot="delete" slot-scope="{row}">
                          <i class="fa fa-trash" @click="deletePopUp(row.id, row.username)"></i>
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
      allUsers: {},

      columns: ['profile_picture', 'username', 'email', 'firstname', 'lastname', 'user_status', 'created_at', 'vendor_status', 'admin_status', 'edit', 'delete'],

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
        filterable: ['profile_picture', 'username', 'email', 'firstname', 'lastname', 'user_status', 'created_at',],
        pagination: { chunk: 10, dropdown: false },
        headings: {
            profile_picture: 'Profile Picture',
            username: 'Username',
            email: 'E-mail',
            firstname: 'Firstname',
            lastname: 'Lastname',
            user_status: 'User Status',
            account_created_at: 'Account Created at',
            edit: 'Edit User',
            vendor_status: 'Vendor Status',
            admin_status: 'Admin Status',
            delete: 'Delete',
        },
        columnsDropdown: true,
        filterAlgorithm: {
          user_status(row, query){
            return (row[0]).includes(query);
            return console.log(row);
          }
        },

      }
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
        let userData = [];
        axios.get('users')
        .then(response => this.rows = response.data)



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

.VueTables {
  text-align: center;
}
.VueTables__error {
  color: red;
}

</style>
