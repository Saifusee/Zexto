<template>
    <div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Edit Product by {{computeProductVendor}}</h3>
              <small>Edit Product Details here.</small>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" @submit.prevent>
                    <div class="form-group">
                        <label for="username"><strong>Product Title</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-title" :value="computeProductTitle" @input="methodProductTitle($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_name">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="titleError in creationErrors.product_name"><li>{{titleError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote-data-1"><strong>Product Introduction</strong> <span>*</span></label>
                        <textarea class="form-control" rows="5" @input="methodProductIntroduction($event.target.value)">{{computeProductIntroduction}} </textarea>
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_introduction">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="data1Error in creationErrors.product_introduction"><li>{{data1Error}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote-data-2"><strong>Product Features</strong> <span>*</span></label>
                        <textarea class="form-control" rows="5" @input="methodProductFeatures($event.target.value)">{{computeProductFeatures}} </textarea>
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_features">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="data2Error in creationErrors.product_features"><li>{{data2Error}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                    <strong>Product Main Image:</strong> <span>*</span>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-main-image" ref="product_main_image" @change="productMainImageUpload">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Product's Description Image:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-description-image" ref="product_description_image" @change="productDescriptionImageUpload">
                        </div>
                    </div>
                    <hr> <br><br>
                    <div style="text-align: center">
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_main_image">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="mainImageError in creationErrors.product_main_image"><li>{{mainImageError}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_description_image">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="descriptionImageError in creationErrors.product_description_image"><li>{{descriptionImageError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote"><strong>Product Amount (in INR)</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-amount" id="productAmount" :value="computeProductAmount" @input="methodProductAmount($event.target.value)" @keypress="amountOnlyDecimals($event, 'amount')">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_amount">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="amountError in creationErrors.product_amount"><li>{{amountError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quote"><strong>Product Stock</strong> <span>*</span></label>
                        <input type="number" class="form-control" name="quote" :value="computeProductStock" @input="methodProductStock($event.target.value)" @keypress="stockOnlyNumber($event)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_stock">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="stockError in creationErrors.product_stock"><li>{{stockError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 1:</strong> <span>*</span>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-1" ref="product_sub_image_1" @change="productSubImageUpload1">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 2:</strong> <span>*</span>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-2" ref="product_sub_image_2" @change="productSubImageUpload2">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 3:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-3" ref="product_sub_image_3" @change="productSubImageUpload3">
                        </div>
                    </div>
                    <br><br><hr>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 4:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-4" ref="product_sub_image_4" @change="productSubImageUpload4">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 5:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-5" ref="product_sub_image_5" @change="productSubImageUpload5">
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                    <strong>Product Sub-Image 6:</strong>
                        <div style="text-indent:1em">
                            <input type="file" class="form-check-input" style="border: solid 1px black" name="product-sub-image-6" ref="product_sub_image_6" @change="productSubImageUpload6">
                        </div>
                    </div>
                    <br><br><hr>
                    <div style="text-align: center">
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_1">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage1Error in creationErrors.product_sub_image_1"><li>{{subImage1Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_2">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage2Error in creationErrors.product_sub_image_2"><li>{{subImage2Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_3">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage3Error in creationErrors.product_sub_image_3"><li>{{subImage3Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_4">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage3Error in creationErrors.product_sub_image_4"><li>{{subImage4Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_5">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage3Error in creationErrors.product_sub_image_5"><li>{{subImage5Error}}</li></ul>
                        </div>
                        <div class="alert alert-danger form-check form-check-inline" style="font-size:12px" v-if="creationErrors.product_sub_image_6">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="subImage3Error in creationErrors.product_sub_image_6"><li>{{subImage6Error}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="category-tag"><strong>Product Colours Detail</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-colors" :value="computeProductColors" @input="methodProductColors($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_colors">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="colorError in creationErrors.product_colors"><li>{{colorError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category-tag"><strong>Product Weight (in Kg)</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-weight" :value="computeProductWeight" @input="methodProductWeight($event.target.value)" @keypress="amountOnlyDecimals($event, 'weight')">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_weight">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="weightError in creationErrors.product_weight"><li>{{weightError}}</li></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category-tag"><strong>Product Size</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-size" :value="computeProductSize" @input="methodProductSize($event.target.value)">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_size">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="sizeError in creationErrors.product_size"><li>{{sizeError}}</li></ul>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="product-tags"><strong>Product Tags</strong> <span>*</span></label>
                        <input type="text" class="form-control" name="product-tags" :value="computeProductTags" @input="methodProductTags($event.target.value)" placeholder="Type Product Tags which help them easy for customers to find.">
                        <div class="alert alert-danger" style="font-size:12px" v-if="creationErrors.product_tags">
                            <ul style="padding:5px; margin: 0px; margin: 0px" v-for="productError in creationErrors.product_tags"><li>{{productError}}</li></ul>
                        </div>
                    </div>
                    <hr>
                    <div> <strong>Taxes:</strong>
                        <multiselect 
                            v-model="value" 
                            :options="options"
                            :searchable="true"
                            track-by="tax_name"
                            label="tax_name"
                            placeholder="Select all the Taxes should be applicable"
                            :multiple="true"
                            :close-on-select="false"
                        >
                            <template slot="tag" slot-scope="props">
                                <span class="span_template"><strong>{{ props.option.tax_name }}</strong> = <strong>  {{ props.option.tax_percentage }}%</strong></span><br>
                            </template>
                        </multiselect>
                    </div> <hr> <br>
                    <button type="submit" class="form-control btn btn-secondary" @click="submitProduct">Edit Product Details</button>
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
        axios.get(`products/${this.id}/edit`)
        .then(response => 
        {
            let data = response.data;
            this.methodProductId(data.id);
            this.methodProductTitle(data.product_name);
            this.methodProductIntroduction(data.product_introduction);
            this.methodProductFeatures(data.product_features);
            this.methodProductAmount(data.product_amount);
            this.methodProductPreviousAmount(data.product_previous_amount);
            this.methodProductStock(data.product_stock);
            this.methodProductFor(data.product_for);
            this.methodProductColors(data.product_colors);
            this.methodProductSize(data.product_size);
            this.methodProductWeight(data.product_weight);
            this.methodProductTags(data.product_tags);
            this.methodProductCategoryTag(data.product_category);
            this.methodProductVendor(data.vendor.username);
            this.value = response.data.taxes;
            console.log(response.data.taxes);
        })
        .catch(error => error)

        this.getAllTaxes();
    },

    data()
    {
        return {
            //Local data for uploaded image files
            creationErrors: '',
            amountValue: "",
            id: this.$route.params.id,
            userId: this.$route.params.userId,
            value: null,
            options: []
        }
    },

    computed:
    {
        ...mapGetters(
            {
                computeProductId: 'getterProductId',
                computeProductTitle: 'getterProductName',
                computeProductIntroduction: 'getterProductIntroduction',
                computeProductFeatures: 'getterProductFeatures',
                computeProductAmount: 'getterProductAmount',
                computeProductPreviousAmount: 'getterProductPreviousAmount',
                computeProductStock: 'getterProductStock',
                computeProductFor: 'getterProductFor',
                computeProductMainImage: 'getterProductMainImage',
                computeProductDescriptionImage: 'getterProductDescriptionImage',
                computeProductSubImage1: 'getterProductSubImage1',
                computeProductSubImage2: 'getterProductSubImage2',
                computeProductSubImage3: 'getterProductSubImage3',
                computeProductSubImage4: 'getterProductSubImage4',
                computeProductSubImage5: 'getterProductSubImage5',
                computeProductSubImage6: 'getterProductSubImage6',
                computeProductColors: 'getterProductColors',
                computeProductSize: 'getterProductSize',
                computeProductWeight: 'getterProductWeight',
                computeProductTags: 'getterProductTags',
                computeProductCategoryTag: 'getterProductCategoryTag',
                computeProductVendor: 'getterProductVendor',
            }
        ),
    },

    methods:
    {
        ...mapActions(
            {
                methodProductId: 'actionProductId',
                methodProductTitle: 'actionProductName',
                methodProductIntroduction: 'actionProductIntroduction',
                methodProductFeatures: 'actionProductFeatures',
                methodProductAmount: 'actionProductAmount',
                methodProductPreviousAmount: 'actionProductPreviousAmount',
                methodProductStock: 'actionProductStock',
                methodProductFor: 'actionProductFor',
                methodProductMainImage: 'actionProductMainImage',
                methodProductDescriptionImage: 'actionProductDescriptionImage',
                methodProductSubImage1: 'actionProductSubImage1',
                methodProductSubImage2: 'actionProductSubImage2',
                methodProductSubImage3: 'actionProductSubImage3',
                methodProductSubImage4: 'actionProductSubImage4',
                methodProductSubImage5: 'actionProductSubImage5',
                methodProductSubImage6: 'actionProductSubImage6',
                methodProductColors: 'actionProductColors',
                methodProductSize: 'actionProductSize',
                methodProductWeight: 'actionProductWeight',
                methodProductTags: 'actionProductTags',
                methodProductCategoryTag: 'actionProductCategoryTag',
                methodProductVendor: 'actionProductVendor',
            }
        ),

        getAllTaxes()
        {
            axios.get(`taxes/${this.userId}`)
            .then(response => this.options = response.data)
            .catch(error => error)
        },

        amountOnlyDecimals(event, inputField)
        {
            let errors, fieldValue;
            if (inputField == "amount") {
                fieldValue = this.computeProductAmount;
                errors = {product_amount: ['Invalid Amount']};
            } else if (inputField == "weight") {
                fieldValue = this.computeProductWeight;
                errors = {product_weight: ['Invalid Weight']};
            }
            event = (event) ? event : window.event;
            let charCode = (event.which) ? event.which : event.keyCode;
            let regex = new RegExp(/^\d*\.?\d*$/);
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                this.creationErrors = errors;
                event.preventDefault();
            } else if(!regex.test(fieldValue)) {
                this.creationErrors = errors;
                event.preventDefault();
                if (inputField == "amount") {
                    this.methodProductAmount("");
                } else if (inputField == "weight") {
                    this.methodProductWeight("");
                }
            }
            else {
                this.creationErrors = "";
                return true;
            }
            
        },

        stockOnlyNumber(evt)
        {
            evt = (evt) ? evt : window.event;
            let charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                this.creationErrors = {product_stock: ["Invalid Stock"]};
                evt.preventDefault();
            } else {
                this.creationErrors = "";
                return true;
            }
        },

        productMainImageUpload()
        {
            this.methodProductMainImage(this.$refs.product_main_image.files[0]);
        },

        productDescriptionImageUpload()
        {
            this.methodProductDescriptionImage(this.$refs.product_description_image.files[0]);

        },
        productSubImageUpload1()
        {
            this.methodProductSubImage1(this.$refs.product_sub_image_1.files[0]);

        },
        productSubImageUpload2()
        {
            this.methodProductSubImage2(this.$refs.product_sub_image_2.files[0]);

        },
        productSubImageUpload3()
        {
            this.methodProductSubImage3(this.$refs.product_sub_image_3.files[0]);

        },
        productSubImageUpload4()
        {
            this.methodProductSubImage4(this.$refs.product_sub_image_4.files[0]);

        },
        productSubImageUpload5()
        {
            this.methodProductSubImage5(this.$refs.product_sub_image_5.files[0]);

        },
        productSubImageUpload6()
        {
            this.methodProductSubImage6(this.$refs.product_sub_image_6.files[0]);

        },

        submitProduct()
        {
            //Getting the selected taxes id
            let taxes = this.value;
            let tax_data = [];
            for(let i =0; i < taxes.length; i++)
            {
                tax_data.push(taxes[i].id);
            }
            let selectedTaxes = JSON.stringify(tax_data);

            let formdata = new FormData();
            formdata.append('id', this.computeProductId);
            formdata.append('product_name', this.computeProductTitle);
            formdata.append('product_introduction', this.computeProductIntroduction);
            formdata.append('product_features', this.computeProductFeatures);
            formdata.append('product_amount', this.computeProductAmount);
            formdata.append('product_previous_amount', this.computeProductPreviousAmount);
            formdata.append('product_stock', this.computeProductStock);
            formdata.append('product_for', this.computeProductFor);
            formdata.append('product_main_image', this.computeProductMainImage);
            formdata.append('product_description_image', this.computeProductDescriptionImage);
            formdata.append('product_sub_image_1', this.computeProductSubImage1);
            formdata.append('product_sub_image_2', this.computeProductSubImage2);
            formdata.append('product_sub_image_3', this.computeProductSubImage3);
            formdata.append('product_sub_image_4', this.computeProductSubImage4);
            formdata.append('product_sub_image_5', this.computeProductSubImage5);
            formdata.append('product_sub_image_6', this.computeProductSubImage6);
            formdata.append('taxes', selectedTaxes);
            formdata.append('product_colors', this.computeProductColors);
            formdata.append('product_size', this.computeProductSize);
            formdata.append('product_weight', this.computeProductWeight);
            formdata.append('product_tags', this.computeProductTags);
            formdata.append('product_category', 0);
            formdata.append('vendor_id', this.$store.getters.getterUserId);

            formdata.append('product_for', "a");
            formdata.append('product_previous_amount', this.computeProductAmount);
            formdata.append('_method', 'put');

            axios.post(`products/${this.id}`, formdata)
            .then(response => 
            {
                this.creationErrors = {};
                this.methodProductId("");
                this.methodProductTitle("");
                this.methodProductIntroduction("");
                this.methodProductFeatures("");
                this.methodProductAmount("");
                this.methodProductPreviousAmount("");
                this.methodProductStock("");
                this.methodProductFor("");
                this.methodProductMainImage("");
                this.methodProductDescriptionImage("");
                this.methodProductSubImage1("");
                this.methodProductSubImage2("");
                this.methodProductSubImage3("");
                this.methodProductSubImage4("");
                this.methodProductSubImage5("");
                this.methodProductSubImage6("");
                this.methodProductColors("");
                this.methodProductSize("");
                this.methodProductWeight("");
                this.methodProductTags("");
                this.methodProductCategoryTag("");
                this.methodProductVendor("");
                this.$router.push({name: 'admin-all-product'});
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
span 
{
    color: #ffcccb;
}
.span_template{
    color: black;
}
</style>