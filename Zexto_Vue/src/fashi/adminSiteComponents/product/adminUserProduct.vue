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

                  <!-- For Product Picture in each row. -->
                      <template slot="product_main_image" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.id}}">
                              <img :src="`${PRODUCT_MAIN_IMAGE}thumb/${row.product_main_image}`" :alt="row.product_name" width="75px" style="border-radius: 75%">
                          </router-link> 
                      </template>
                  <!-- For Product Amount in each row. -->
                      <template slot="product_amount" slot-scope="{row}">
                          <i class="fa fa-inr"></i> {{row.product_amount}}
                      </template>
                  <!-- For Product Previous Amount in each row. -->
                      <template slot="product_previous_amount" slot-scope="{row}">
                           <i class="fa fa-inr"></i> {{row.product_previous_amount}}
                      </template>
                        <!-- For Vendor Details in each row. -->
                      <template slot="vendor" slot-scope="{row}">
                          <router-link tag="a" :to="{name: 'user-profile', params: {id: row.vendor.id}}">{{row.vendor.username}}</router-link>
                      </template>
                        <!-- For Product Tags in each row. -->
                      <template slot="product_tags" slot-scope="{row}">
                          <template v-if="row.product_tags !== ''">
                              {{row.product_tags}}
                          </template>
                          <template v-else>
                              ---No Tags---
                          </template>
                      </template>
                      <!-- For Product Status -->
                      <template slot="product_status" slot-scope="{row}">
                          <template v-if="row.product_status == 'Approved'">
                          <span style="color:green">{{row.product_status}}</span>
                          </template>
                          <template v-if="row.product_status == 'Disapproved'">
                          <span style="color:red">{{row.product_status}}</span>
                          </template>
                      </template>
                  <!-- For Change Status Button in each row. -->
                      <template slot="change_status" slot-scope="{row}">
                          <i class="fa fa-circle" @click="changeStatusPopUp(row.id, row.product_name)"></i>
                      </template>
                  <!-- For Edit Button in each row. -->
                      <template slot="edit" slot-scope="{row}">
                          <i class="fa fa-edit" @click="editProduct(row.id)"></i>
                      </template>
                  <!-- For Delete Button in each row. -->
                      <template slot="delete" slot-scope="{row}">
                          <i class="fa fa-trash" @click="deletePopUp(row.id, row.product_name)"></i>
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
      id: this.$route.params.id,

      columns: ['product_main_image', 'id', 'product_name', 'product_amount', 'product_previous_amount', 'product_stock', 'product_tags', 'product_status', 'product_category', 'created_at', 'updated_at', 'edit', 'delete'],

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
        filterable: ['product_main_image', 'id', 'product_name', 'product_amount', 'product_previous_amount', 'product_stock', 'product_tags', 'product_status', 'product_category', 'created_at', 'updated_at'],
        pagination: { chunk: 10, dropdown: false },
        headings: {
            product_main_image: 'Product Image',
            id: 'SKU',
            product_name: 'Product Name',
            product_amount: 'Product Amount',
            product_previous_amount: 'Product Previous Amount',
            product_stock: 'Stock Left',
            product_tags: 'Tags',
            product_status: 'Status',
            product_category: 'Category',
            created_at: 'Created At',
            updated_at: 'Updated At',
            edit: 'Edit',
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
    this.productsDetails();

    ///////    Listening to the events from EventBus if user click confirm on Modal   ///////

    //for changing user status from vendor/user (we get id from the data on event emitting)
    eventBus.$on('event-admin-allProduct-delete', (id) =>
    {
      let url = `products/${id}`
      axios.delete(url)
      .then(response => this.productsDetails())
      .catch(error => error)  
    });

    //for changing user status from vendor/user (we get id from the data on event emitting)
    eventBus.$on('event-admin-allProduct-change-status', (id) =>
    {
      let url = `products/${id}/status`
      axios.post(url)
      .then(response => this.productsDetails())
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
    productsDetails()
    {
        let userData = [];
        axios.get(`products/user/${this.id}`)
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
    deletePopUp(id, productName)
    { 
      let title, body, button, source;
      title = `Product Delete`;
      body = `Are you sure to Delete "${productName}" Data.`;
      button = `Delete "${productName}"`;
      source = `admin-allProduct-delete`;
      this.callModal(true, title, body, button, id, source);

    },

    //Calling Modal for changing user's admin status
    changeStatusPopUp(id, productName)
    {
      let title, body, button, source;
      title = `Change Product Approval Status`;
      body = `Are you sure to change "${productName}" Status`;
      button = `Change`;
      source = `admin-allProduct-change-status`;
      this.callModal(true, title, body, button, id, source);
    },

    editProduct(productId)
    {
      this.$router.push({name: 'admin-edit-product', params: { id: productId, userId: this.$store.getters.getterUserId }});
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

i {
  font-size: 15px;
}

.VueTables {
  text-align: center;
}
.VueTables__error {
  color: red;
}

</style>
