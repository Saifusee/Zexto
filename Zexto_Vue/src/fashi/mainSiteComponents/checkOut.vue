<template>
    <div>
        <!-- Breadcrumb Section Begin -->
        <div class="breacrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text product-more">
                            <a :href="$router.resolve({name: 'home'}).href"><i class="fa fa-home"></i>Home</a>
                            <router-link tag="a" :to="{name: 'shop'}">Shop</router-link>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Begin -->

        <!-- Shopping Cart Section Begin -->
        <section class="checkout-section spad">
            <div class="container">
                <div class="checkout-form">
                    <div class="row">
                    <div class="col-lg-6">
                        <h4>Shipping Address</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" v-model="address1" placeholder="Address 1">
                                <input type="text" v-model="address2" placeholder="Address 2">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" v-model="city">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode / ZIP<span>*</span></label>
                                <input type="text" v-model="zipcode">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">State<span>*</span></label>
                                <input type="text" v-model="state">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Country<span>*</span></label>
                                <input type="text" v-model="country">
                            </div>
                        </div>
                            <!-- <div class="checkout-content">
                                <input type="text" disabled placeholder="Enter Your Coupon Code">
                            </div> -->
                    </div>
                        <!-- Rendering a payu submit form. -->
                        <div id="SubmitForm" v-show="false"> </div>
                        <div class="col-lg-6">
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        <li class="fw-normal">Combination x 1 <span>$60.00</span></li>
                                        <li class="fw-normal">Combination x 1 <span>$60.00</span></li>
                                        <li class="fw-normal">Combination x 1 <span>$120.00</span></li>
                                        <li class="fw-normal">Subtotal <span>$240.00</span></li>
                                        <li class="total-price">Total <span>$240.00</span></li>
                                    </ul>
                                    <!-- <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Cheque Payment
                                                <input type="checkbox" id="pc-check">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Paypal
                                                <input type="checkbox" id="pc-paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class="order-btn">
                                        <button class="site-btn place-btn" @click="placeOrder">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shopping Cart Section End -->
    </div>
</template>
<script>
import axios from 'axios'
import { mapGetters, mapActions } from 'vuex'

export default {

    data()
    {
        return {
            id: this.$route.params.id,
            orderResponse: "",

            //Address data
            address1: "",
            address2: "",
            city: "",
            state: "",
            country: "",
            zipcode: "",
        }
    },
    
    methods:
    {
        placeOrder()
        {
            let data = {
                'id': this.id,
                'products_ids': [2,4,6,8,10],
                'product_quantities': [3,2,1,4,2],
                'address1': this.address1,
                'address2': this.address2,
                'city': this.city,
                'zipcode': this.zipcode,
                'state': this.state,
                'country': this.country,
            };

            if(this.address1 == '' || this.address2 == '' || this.city == ''  || this.zipcode == '' || this.state == '' || this.country == ''){
                  this.callModal(true, 'Warning', 'All the input fields are required for shipping address.', 'hide', null, null);
                  return;
              } else if (typeof(data.products_ids) === 'undefined' && typeof(data.product_quantities) === 'undefined') {
                  this.callModal(true, 'Warning', 'No items listed in cart for chekout', 'hide', null, null);
                  return;
              } else {
                  axios.post('checkout/payment/payu', data)
                  .then(response =>
                  {
                      this.orderResponse = response.data;
                      this.redirectToPayu();
                  })
                  .catch(error => error)
              }
        },

        redirectToPayu()
        {
            //Storing all the details we get from backend and had to send to Payu in post request.
            let data = this.orderResponse;
            //Creating a form to submit the deatils as post to payu with all the details.
            let form = `<form action="${data.url}" name="payuForm" method="post">
                        <input type="hidden" name="key" value="${data.key}">
                        <input type="hidden" name="txnid" value="${data.txnid}">
                        <input type="hidden" name="amount" value=${data.amount}>
                        <input type="hidden" name="productinfo" value="${data.productinfo}">
                        <input type="hidden" name="firstname" value="${data.firstname}">
                        <input type="hidden" name="lastname" value="${data.lastname}">
                        <input type="hidden" name="email" value="${data.email}">
                        <input type="hidden" name="hash" value="${data.hash}">
                        <input type="hidden" name="phone" value="${data.phone}">
                        <input type="hidden" name="surl" value="${data.surl}">
                        <input type="hidden" name="furl" value="${data.furl}">
                        <input type="hidden" name="service_provider" value="${data.service_provider}">
                        <input type="hidden" name="address1" value="${data.address1}">
                        <input type="hidden" name="address2" value="${data.address2}">
                        <input type="hidden" name="city" value="${data.city}">
                        <input type="hidden" name="state" value="${data.state}">
                        <input type="hidden" name="country" value="${data.country}">
                        <input type="hidden" name="zipcode" value="${data.zipcode}">
                        </form>`;
            //Inserting the whole form to html
            document.getElementById("SubmitForm").innerHTML = form;
            //Getting the whole form back
            let payuForm = document.forms.payuForm;
            //Submitting the form
            payuForm.submit();
        },

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
    },

}
</script>