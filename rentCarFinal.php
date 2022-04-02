<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION["username"])){
        header("Location: index.php");
    }
    include_once("views/header.php");
    include_once("views/navigation.php");
    include_once("data/connection.php");
    $carID = $_GET["carIDPHP"];
    $query = "SELECT *,cb2.name as cars_brandName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN transmission t ON t.transmissionID = c.transmissionID WHERE c.carsID = :carID";
    $prepare = $connection->prepare($query);
    $prepare ->bindParam(":carID", $carID);
    $prepare ->execute();
    $result = $prepare ->fetch();
    if($result){
    echo "<div class='container-fluid min-vh-100 d-flex flex-column justify-content-between align-items-center'>";
    echo "<h3 class='p-2 text-center'>$result->cars_brandName $result->model</h3>";
    echo "<h5 class='p-2 text-center text-danger'>Price: $result->price &euro; / day</h5>";
    ?>
    <form class='p-5 w-50 text-center d-flex flex-column justify-content-between ' action="" method="">
    <label for="beginDate" class='font-weight-bold'>Begin Date</label>
    <input type="date" name="beginDate" id="beginDate"><br>
    <label for="endDate" class='font-weight-bold'>End Date</label>
    <input type="date" id="endDate"><br>
    <label for="totalPrice" class='text-danger h4'>Total Price </label>
    <h5 class='text-center text-danger font-weight-bold' name='totalPrice' id='totalPrice'></h5>
    <?php
        echo "<input type='hidden' data-id='$carID'>";
        echo "<input type='hidden' data-price='$result->price'>";
    ?>
    <input type="button" class="btn btn-dark" id="finalRentButton" value="Rent"><br>
    <span class='mt-5 h5 text-danger font-weight-bold text-center w-100' id='errorDate'></span>
    </form>
    <?php
    echo "</div>";
?>
<?php
    }
    else{
        http_response_code(404);
    }
    include_once("views/footer.php");
?>