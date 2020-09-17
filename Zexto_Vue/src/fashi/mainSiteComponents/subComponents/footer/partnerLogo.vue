<template>
    <div>
        <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img :src="ROOT_URL + 'img/logo-carousel/logo-1.png'" alt="">
                    </div>:
                 </div>
                 <div class="logo-item">
                    <div class="tablecell-inner">
                        <img :src="ROOT_URL + 'img/logo-carousel/logo-2.png'" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img :src="ROOT_URL + 'img/logo-carousel/logo-3.png'" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img :src="ROOT_URL + 'img/logo-carousel/logo-4.png'" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img :src="ROOT_URL + 'img/logo-carousel/logo-5.png'" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
export default {
    data()
    {
        return{
             ROOT_URL: "http://localhost:8080/src/fashi/",
        }
    }
}
</script>