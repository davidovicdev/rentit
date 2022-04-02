<?php
    session_start();
    // NOT ADMIN
    if($_SESSION["roleID"] != 2 ){
        header("Location: index.php");
    }
    // ONLY ADMIN
    if($_SESSION["roleID"] == 2):
    include_once("views/header.php");
    include_once("views/navigation.php");
?>
    <div class="container-fluid min-vh-100 max-width-100">
        <div class="row">
            <div class="col-lg-1 color min-vh-100 max-vh-100 d-flex flex-column justify-content-between p-2">
                <button id='answers' class='font-weight-bold btn bg-light text-dark'>answers</button>
                <button id='cars' class='font-weight-bold btn bg-light text-dark'>cars</button>
                <button id='cars_body' class='font-weight-bold btn bg-light text-dark'>cars_body</button>
                <button id='cars_brand' class='font-weight-bold btn bg-light text-dark'>cars_brand</button>
                <button id='contact' class='font-weight-bold btn bg-light text-dark'>contact</button>
                <button id='drive' class='font-weight-bold btn bg-light text-dark'>drive</button>
                <button id='images'class='font-weight-bold btn bg-light text-dark'>images</button>
                <button id='menu' class='font-weight-bold btn bg-light text-dark'>menu</button>
                <button id='roles' class='font-weight-bold btn bg-light text-dark'>roles</button>
                <button id='survey' class='font-weight-bold btn bg-light text-dark'>survey</button>
                <button id='transmission' class='font-weight-bold btn bg-light text-dark'>transmission</button>
                <button id='users' class='font-weight-bold btn bg-light text-dark'>users</button>
                <button id='users_cars' class='font-weight-bold btn bg-light text-dark'>users_cars</button>
            </div>
            <div class="col-lg-11">
                    <table id='table' class='table'>
                    </table>
            <h5 class='text-success text-center p-3 font-weight-bold' id='success'></h5>
            <h5 class='text-danger text-center p-3 font-weight-bold' id='error'></h5>
            </div>
        </div>
    </div>

<?php
    include_once("views/footer.php");
    endif;
?>