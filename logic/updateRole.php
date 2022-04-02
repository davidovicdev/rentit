<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("functions.php");
            include_once("../data/connection.php");
            $roleID = $_POST["roleIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE roles SET role = :name WHERE roleID = :roleID";
            $prepared = $connection->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":roleID", $roleID);
            $result = $prepared ->execute();
            echo json_encode($result);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo $e->getMessage();
        }
    }
    else{
        http_response_code(404);
    }
?>