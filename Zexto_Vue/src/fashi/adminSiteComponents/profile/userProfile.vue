<template>
    <div class="title">
        <div>
            <img :src="USER_IMAGE + userData.profile_picture" width="200px">
        </div>
            <div class="table-responsive" width="100px">
                <table class="table table-bordered text-centered" cellspacing="0" >
                    <!-- Using Transition group to add transitions where transition group tag going to replace with tbody in DOM -->
                    <tbody>                   
                        <tr>
                            <td class="tags">Username</td>
                            <td class="value">{{userData.username}}</td>
                        </tr>
                        <tr>
                            <td class="tags">E-mail</td>
                            <td class="value">{{userData.email}}</td>
                        </tr>
                        <tr>
                            <td class="tags">Firstname</td>
                            <template v-if="userData.firstname == null">
                                <td class="value">---Not Given---</td>
                            </template>
                            <template v-else>
                            <td class="value">{{userData.firstname}}</td>
                            </template>
                        </tr>
                        <tr>
                            <td class="tags">Lastname</td>
                            <template v-if="userData.lastname == null">
                                <td class="value">---Not Given---</td>
                            </template>
                            <template v-else>
                            <td class="value">{{userData.lastname}}</td>
                            </template>                        </tr>
                        <tr>
                            <td class="tags">Is Admin</td>
                            <template v-if="userData.is_admin === 1">
                                <td class="value">Yes</td>
                            </template>
                            <template v-if="userData.is_admin === 0">
                                <td class="value">No</td>
                            </template>                       
                        </tr>
                        <tr>
                            <td class="tags">Is Vendor</td>
                            <template v-if="userData.is_vendor === 1">
                                <td class="value">Yes</td>
                            </template>
                            <template v-if="userData.is_vendor === 0">
                                <td class="value">No</td>
                            </template>                       
                        </tr>
                        <tr>
                            <td class="tags">Account created at</td>
                            <td class="value">{{userData.created_at}}</td>
                        </tr>
                        <tr>
                            <td class="tags">Account updated at</td>
                            <td class="value">{{userData.updated_at}}</td>
                        </tr>
                        <tr>
                            <td class="tags">Total Blogs</td>
                            <td class="value"><router-link :to="{name: 'admin-user-blog', params: {id: userData.id}}" tag="a" class="value">{{userData.blogs_count}} (Click Here)</router-link></td>
                        </tr>
                        <tr>
                            <td class="tags">Total Comments on Blogs</td>
                            <td class="value"><router-link :to="{name: 'admin-user-comments', params: {id: userData.id}}" tag="a" class="value">{{userData.comments_count}} (Click Here)</router-link></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <button @click="$router.push({name: 'admin-edit-user', params: {id: userData.id}})" style="background-color: grey; color: white">
                    Edit {{userData.username}}'s Account Details
                </button>
                <button @click="deletePopUp(userData.id, userData.username)" style="background-color: #ffcfcf; color: black">
                    Delete {{userData.username}}'s Account
                </button>
                
            </div>
        </div>
</template>

<script>
import { mapActions } from 'vuex';
import axios from 'axios'
import { eventBus } from './../../../main';
export default {
    created()
    {
        axios.get(`users/${this.id}/edit`)
        .then(response => 
        {
            this.userData = response.data;
        })
        .catch(error => error)

    //for Delete User Account (we get id from the data on event emitting)
    eventBus.$on('event-admin-allUser-delete-profile', (id) =>
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
    },

    data()
    {
        return{

            id: this.$route.params.id,
            userData: "",
        }
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
        source = `admin-allUser-delete-profile`;
        this.callModal(true, title, body, button, id, source);

        },
    },
}
</script>


<style scoped>
.title{
    text-align: center;
}
button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}
a {
    text-decoration: none;
    font-size: 22px;
    color: black;
}
button:hover, a:hover {
    opacity: 0.7;
}

img {
    border-radius: 100%;
    border: 1px solid black;
    margin-top: 10px;
    margin-bottom: 10px;
}

table{
    border-radius: 5px;
    width: 50%;
    margin: auto;
    float: none;
}
.tags{
    background-color: #2b2b2b;
    color: white;

}
.value{
    background-color: #111111;
    color: white;

}
</style>