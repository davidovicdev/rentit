<?php
    session_start();
    include_once("views/header.php");
    include_once("views/navigation.php");
?>
    <div class="container-fluid min-vh-100 d-flex flex-row row">
        <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center text-center ">
            <h1 class='mb-5 font-weight-bold'>Who are we?</h1>
            <h3 class='mb-5'>We are <span class='text-danger font-weight-bold'>RENTIT</span> , perfect place for your dreams on day</h3>
            <p class='mb-2'>We started our bussiness in 1989 and currently we are one of the best rent car companies on the world. We own more then 100 cars and we are ready to give you any car you order !</p>
            <p><span class="text-danger font-weight-bold">RENTIT</span> has over 80 rent car stores in the world, so anywhere you are you can make your dream goes real for very low prices.</p>
        </div>
        <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center">
            <img src="assets/img/thumbnail.jpg" alt ="thumbnail" class="img-fluid rounded">
        </div>
    </div>
<?php
    include_once("views/footer.php");
?>