<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Add Tax</h3>
              <small>Add a Tax to add it to your products</small>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" @submit.prevent>
                    <div class="form-group">
                        <label for="username"><strong>Tax Name</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-title" :value="computeTaxName" @input="methodTaxName($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.tax_name">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="titleError in creationErrors.tax_name"><li>{{titleError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote-data-1"><strong>Tax Description</strong></label>
                        <textarea class="form-control" rows="5" @input="methodTaxDescription($event.target.value)">{{computeTaxDescription}} </textarea>
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.tax_descriptiopn">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="data1Error in creationErrors.tax_descriptiopn"><li>{{data1Error}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote"><strong>Tax Value (in Percentage)</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-amount" id="productAmount" :value="computeTaxPercentage" @input="methodTaxPercentage($event.target.value)" @keypress="amountOnlyDecimals($event)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.tax_percentage">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="amountError in creationErrors.tax_percentage"><li>{{amountError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="form-control btn btn-secondary" @click="submitTax">Create Tax</button>
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
        //JUst clearing all previous data regarding product in vuex
        this.methodTaxName("");
        this.methodTaxDescription("");
        this.methodTaxPercentage("");
 
    },

    data()
    {
        return {
            //Local data for uploaded image files
            creationErrors: '',
        }
    },

    computed:
    {
        ...mapGetters(
            {
                computeTaxName: 'getterTaxName',
                computeTaxDescription: 'getterTaxDescription',
                computeTaxPercentage: 'getterTaxPercentage',
            }
        ),
    },

    methods:
    {
        ...mapActions(
            {
                methodTaxName: 'actionTaxName',
                methodTaxDescription: 'actionTaxDescription',
                methodTaxPercentage: 'actionTaxPercentage',
            }
        ),

        amountOnlyDecimals(event, inputField)
        {
            let errors = {tax_percentage: ['Invalid Data, should be in 0.00 format']};

            event = (event) ? event : window.event;
            let charCode = (event.which) ? event.which : event.keyCode;
            let regex = new RegExp(/^\d*\.?\d*$/);
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                this.creationErrors = errors;
                event.preventDefault();
            } else if(!regex.test(this.computeTaxPercentage)) {
                this.creationErrors = errors;
                event.preventDefault();
                this.methodTaxPercentage("");
            }
            else {
                this.creationErrors = "";
                return true;
            }
            
        },

        submitTax()
        {
            let formdata = new FormData();
            formdata.append('tax_name', this.computeTaxName);
            formdata.append('tax_description', this.computeTaxDescription);
            formdata.append('tax_percentage', this.computeTaxPercentage);
            formdata.append('user_id', this.$store.getters.getterUserId);

            axios.post('taxes', formdata)
            .then(response => 
            {
                this.creationErrors = {};
                this.methodTaxName("");
                this.methodTaxDescription("");
                this.methodTaxPercentage("");
                this.$router.push({name: 'admin-all-tax', params: {id: this.$store.getters.getterUserId}});
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