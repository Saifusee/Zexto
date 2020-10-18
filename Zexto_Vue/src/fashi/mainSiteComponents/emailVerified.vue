<template>
    <div>
        <div class="flex-center position-ref full-height">
                <div class="top-right links">


                </div>

            <div class="content">
                <template v-if="success">
                <div class="title m-b-md alert alert-success">
                    Your E-mail verified successfully.
                </div>
                </template>

                <template v-if="!success">
                <div class="title m-b-md alert alert-danger">
                    E-mail verification failed.
                </div>
                </template>

                <div class="links">
                    <a :href="DOMAIN_FRONTEND">&#8592; Go To Homepage</a>
                    <a :href="`${DOMAIN_FRONTEND}login`">Go To Login Page &#8594;</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { DOMAIN_FRONTEND } from '../../constant';

export default {
    created()
    {
        axios.post('check-email', {
            'id': this.id,
            'token': this.token,
        })
        .then(response => 
        {
            if(response.data.message == 'E-mail Verification failed')
            {
                this.success = false;
            } else if(response.data.message == 'E-mail Verified Successfully')
            {
                this.success = true;
            }
        })
        .catch(error => error)
    },

    deactivated()
    {
        window.location = DOMAIN_FRONTEND;
    },

    data()
    {
        return {
            token: this.$route.params.token,
            id: this.$route.params.id,
            success: false,
        };
    },
}
</script>
<style scoped>
    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }
    
    .title2 {
        font-size: 44px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>