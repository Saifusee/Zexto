<template>
    <div>
        <div>
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{modalTitle}}</h5>
                        <button class="close" aria-label="Close" @click="popUpCancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">{{modalBody}}</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" @click="popUpCancel">Cancel</button>
                        <button class="btn btn-primary" @click="popUpApprove" v-if="buttonVisible()">{{modalButton}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { eventBus } from './../main'
export default {

    computed:
    {
        ...mapGetters(
            {
                //Getting all the value set from source where modal calls
                modalTitle: 'getterModalTitle',
                modalBody: 'getterModalBody',
                modalButton: 'getterModalButton',
                modalData: 'getterModalData',
                modalSource: 'getterModalSource',
            }
        ),
    },

    methods:
    {
        ...mapActions(
        {
            //Getting All modal action to make changes to modal data
            methodModalVisibility: 'actionModalVisibility',
            methodModalTitle: 'actionModalTitle',
            methodModalBody: 'actionModalBody',
            methodModalButton: 'actionModalButton',
            methodModalData: 'actionModalData',
            methodModalSource: 'actionModalSource',
        }
        ),

        //Reseting all data related to Modal in Vuex.
        resetPopUp()
        {
            this.methodModalVisibility(false);
            this.methodModalTitle('');
            this.methodModalBody('');
            this.methodModalButton('');
            this.methodModalData('');
            this.methodModalSource('');
        },

        //When Modal Cancels
        popUpCancel()
        {
            this.resetPopUp();
        },

        buttonVisible()
        {
            if(this.modalButton === 'hide')
            {
                return false;
            } else {
                return true;
            }
        },

        //When User select confirm button of modal
        popUpApprove()
        {
            //Getting source from where modal call via vuex modal.js
            let source = this.modalSource;
            //Getting data set, from where modal call via vuex modal.js
            let data = this.modalData;

            //Checking based on source from where it originated what event should launch so that eventBus.$on catch it and perform relevant functionality on source.
            switch(source)
            {
                //adminAllUser.vue related source
                case "admin-allUser-delete":
                eventBus.$emit('event-admin-allUser-delete', data);
                    break;

                case "admin-allUser-delete-profile":
                eventBus.$emit('event-admin-allUser-delete-profile', data);
                this.$router.push({name: 'admin-all-user'});
                    break;

                case "admin-allUser-change-vendorStatus":
                eventBus.$emit('event-admin-allUser-change-vendorStatus', data);
                    break;

                case "admin-allUser-change-adminStatus":
                eventBus.$emit('event-admin-allUser-change-adminStatus', data);
                    break;

                //adminAllBlog.vue related source
                case "admin-allBlog-delete":
                eventBus.$emit('event-admin-allBlog-delete', data);
                    break;

                case "admin-allBlog-change-status":
                eventBus.$emit('event-admin-allBlog-change-status', data);
                    break;

                //adminAllComments.vue related source
                case "admin-allComment-delete":
                eventBus.$emit('event-admin-allComment-delete', data);
                    break;

                case "admin-allComment-change-status":
                eventBus.$emit('event-admin-allComment-change-status', data);
                    break;

                case "admin-allComment-change-admin-status":
                eventBus.$emit('event-admin-allComment-change-admin-status', data);
                    break;                 



            };

            //Hiding modal and resetting all value.
            this.resetPopUp();
        }
    }
}
</script>