<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">All Taxes</h3>
              <small>Details of all the taxes created by you.</small>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <v-client-table :data="rows" :columns="columns" :options="options">
                  <!-- For Edit Button in each row. -->
                      <template slot="edit" slot-scope="{row}">
                          <i class="fa fa-edit" @click="editProduct(row.id)"></i>
                      </template>
                  <!-- For Delete Button in each row. -->
                      <template slot="delete" slot-scope="{row}">
                          <i class="fa fa-trash" @click="deletePopUp(row.id, row.tax_name)"></i>
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

      columns: ['id', 'tax_name', 'tax_percentage', 'tax_description', 'created_at', 'updated_at', 'edit', 'delete'],

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
        filterable: ['id', 'tax_name', 'tax_percentage', 'tax_description', 'created_at', 'updated_at',],
        pagination: { chunk: 10, dropdown: false },
        headings: {
            id: 'Tax ID',
            tax_name: 'Tax Name',
            tax_percentage: 'Tax Percentage',
            tax_description: 'Tax Description',
            created_at: 'Created At',
            updated_at: 'Updated At',
            edit: 'Edit',
            delete: 'Delete',
        },
        columnsDropdown: true,
      }
    };
  },

  created()
  {
    //To show table when component loaded.
    this.taxesDetails();

    ///////    Listening to the events from EventBus if user click confirm on Modal   ///////

    //for changing user status from vendor/user (we get id from the data on event emitting)
    eventBus.$on('event-admin-allTaxes-delete', (id) =>
    {
      let url = `taxes/${id}`
      axios.delete(url)
      .then(response => this.taxesDetails())
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
    taxesDetails()
    {
        axios.get(`taxes/${this.id}`)
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
    deletePopUp(id, taxName)
    { 
      let title, body, button, source;
      title = `Tax Delete`;
      body = `Are you sure to Delete "${taxName}" Data.`;
      button = `Delete "${taxName}"`;
      source = `admin-allTaxes-delete`;
      this.callModal(true, title, body, button, id, source);

    },

    editProduct(taxId)
    {
      this.$router.push({name: 'admin-edit-tax', params: { id: taxId }});
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
i{
  font-size: 15px;
}

.VueTables {
  text-align: center;
}
.VueTables__error {
  color: red;
}

</style>
