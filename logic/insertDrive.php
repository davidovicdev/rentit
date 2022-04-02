<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("functions.php");
            include_once("../data/connection.php");
            $name= $_POST["namePHP"];
            $query = "INSERT INTO drive VALUES (null, :name)";
            $prepared = $connection->prepare($query);
            $prepared -> bindParam(":name", $name);
            $result = $prepared ->execute();
            echo json_encode($result);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo $e->getMessage();
            echo json_encode(0);
        }
    }
    else{
        http_response_code(404);
    }
?>