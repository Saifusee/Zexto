<template>
    <div>
        <div class="container-fluid">
          <!-- 404 Error Text -->
                <div class="row text-center">
                    <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                        <div class="row">
                            <div class="col-lg-8 col-12 col-sm-10 offset-ls-2 offset-sm-1">
                                <h1 class="m-0">404</h1>
                                <h6>Sorry something went wrong, we are not able to find page you are looking for.</h6>
                                <p><a :href="$router.resolve({name: 'home'}).href"><button class="btn btn-secondary">&larr; Back to Home Page</button></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<style>
body{
    margin-top: 150px;
    background-color: #c4ccd9;
}
.error-main{
    background-color: #fff;
    box-shadow: 0px 10px 10px -10px #5D6572;
}

.error-main h1 {
    font-weight: bold;
    color: #444444;
    font-size: 150px;
    text-shadow: 2px 4px 5px #6E6E6E;
}

.error-main h6 {
    color: #42494F;
}

.error-main p {
    color: #9897A0;
    font-size: 14px;
    margin: 10px;
}
</style>