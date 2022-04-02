<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include_once("views/header.php");
    include_once("views/navigation.php");
    try{
        include_once("data/connection.php");
        $carID = $_GET["carIDPHP"];
        $query = "SELECT *,cb2.name as cars_brandName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN transmission t ON t.transmissionID = c.transmissionID WHERE c.carsID = :carID";
        $prepared = $connection -> prepare($query);
        $prepared -> bindParam(":carID", $carID);
        $prepared -> execute();
        $result = $prepared ->fetch();
        if($result){
            echo "<div class='container-fluid '>";
            echo "<h1 class='text-center pt-3 text-dark'>Rent car</h1>";
            echo "<div class='m-5 row d-flex justify-content-around align-items-center'>";
            echo "<img class='img-fluid p-5 w-50' src='$result->path' alt='$result->model'>";
            echo "<table class='m-5' justify-content-right'>";
            echo "<tr><td class='h4 pt-2'>Brand</td><td class='h5 pt-2 pl-5'>$result->cars_brandName</td></tr>
                  <tr><td class='h4 pt-2'>Model</td><td class='h5 pt-2 pl-5'>$result->model</td></tr>
                  <tr><td class='h4 pt-2'>Body</td><td class='h5 pt-2 pl-5'>$result->cars_bodyName</td></tr>
                  <tr><td class='h4 pt-2'>Drive</td><td class='h5 pt-2 pl-5'>$result->driveName</td></tr>
                  <tr><td class='h4 pt-2'>Transmission</td><td class='h5 pt-2 pl-5'>$result->transmissionName</td></tr>
                  <tr><td class='h4 pt-2'>KM</td><td class='h5 pt-2 pl-5'>$result->km</td></tr>
                  <tr><td class='h4 pt-2'>KW</td><td class='h5 pt-2 pl-5'>$result->kw</td></tr>
                  <tr><td class='text-danger h4 pt-2'>Price</td><td class='text-danger h5 pt-3 pl-5'>$result->price &euro; / day</td></tr>
                  <tr><td class='colspan-2 pt-2'><button name='finalRent' class='btn btn-dark w-100'id='$carID'>RENT IT</button></td></tr>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        }
        else{
            http_response_code(404);
        }
        
    }
    catch(PDOException $e){
        http_response_code(500);
        echo $e->getMessage();
    }
    include_once("views/footer.php");
?>