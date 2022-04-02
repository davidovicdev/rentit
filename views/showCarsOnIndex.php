<div class="container-fluid" style="background-color: rgba(42, 46, 51, 1);">
    <h3 class='font-weight-bold text-light text-center p-3'>Check this offers</h3>
    <div class="row justify-content-center text-center text-light">
        
            <?php 
                include_once("data/connection.php");
                include_once("logic/functions.php");
                $query = "SELECT *,cb2.name as cars_brandName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN transmission t ON t.transmissionID = c.transmissionID ORDER BY RAND() LIMIT 4";
                $result = $connection->query($query)->fetchAll();
                foreach($result as $res){
                        //CARS BRAND NAME
                    echo "<div class='col-lg-3 p-5 border d-flex flex-column justify-content-between border-dark'>";
                    echo " <span class='text-uppercase font-weight-bold h5 m-1'>$res->cars_brandName $res->model </span><br><br>";
                    echo "<img src='$res->path' class='img-fluid'>";
                    echo "<table class='text-left mt-5'>
                    <tr><td class='h6'>Body</td><td class='pl-5'>$res->cars_bodyName</td></tr>
                    <tr><td class='h6'>Drive</td><td class='pl-5'>$res->driveName</td></tr>
                    <tr><td class='h6'>Transmission</td><td class='pl-5'>$res->transmissionName</td></tr>
                    <tr><td class='h6'>KM</td><td class='pl-5'>$res->km</td></tr>
                    <tr><td class='h6'>KW</td><td class='pl-5'>$res->kw</td></tr>
                    <tr><td class='h6 text-danger'>Price</td><td class='text-danger pl-5'>$res->price &euro; / day</td></tr>";
                    echo "</table>";
                    echo "<button name='rent' class='btn btn-light text-dark w-100 font-weight-bold text-uppercase mt-5' id='$res->carsID'>Rent</button>";
                    echo "</div>";
                }
            ?>
    </div>
    <h3 class='text-light text-center p-3 h5 m-0'>You can see more cars <a href='prices.php' class='link'>here</a></h3>
</div>