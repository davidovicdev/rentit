<div class="container-fluid" style="background-color: rgba(42, 46, 51, 1);">
    <h3 class='font-weight-bold text-light text-center p-3'>Our cars and prices</h3>
    <div class="row justify-content-center text-center text-light">
        
    <?php 
                include_once("data/connection.php");
                include_once("logic/functions.php");
                // Find out how many items are in the table
                $total = $connection->query('
                    SELECT
                        COUNT(*)
                    FROM
                        cars
                ')->fetchColumn();

                // How many items to list per page
                $limit = 8;

                // How many pages will there be
                $pages = ceil($total / $limit);

                // What page are we currently on?
                $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                    'options' => array(
                        'default'   => 1,
                        'min_range' => 1,
                    ),
                )));

                // Calculate the offset for the query
                $offset = ($page - 1)  * $limit;

                // Some information to display to the user
                $start = $offset + 1;
                $end = min(($offset + $limit), $total);

                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


                // Prepare the paged query
                $prepared = $connection->prepare('
                SELECT *,cb2.name as cars_brandName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN transmission t ON t.transmissionID = c.transmissionID LIMIT :limit OFFSET :offset
                ');

                // Bind the query params
                $prepared->bindParam(':limit', $limit, PDO::PARAM_INT);
                $prepared->bindParam(':offset', $offset, PDO::PARAM_INT);
                $prepared->execute();

                // Do we have any results?
                if ($prepared->rowCount() > 0) {
                    // Define how we want to fetch the results
                    $prepared->setFetchMode(PDO::FETCH_OBJ);
                    $result = new IteratorIterator($prepared);
                    // Display the results
                    foreach ($result as $res) {
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
                        
            } else {
                echo '<p>No results could be displayed.</p>';
            }
            ?>
            
    </div>
    <?php
            echo "<ul class='pagination m-0 mt-4 d-flex justify-content-center p-2 '>";
            for($i=1; $i<=$pages;$i++){
                $class= $page == $i ? 'btn-info' : 'btn-secondary';
                echo "<li class='$class m-1'><a class='btn text-light' href='?page=$i'>$i</a></li>";
            }
            echo "</ul>";
    ?>
</div>
