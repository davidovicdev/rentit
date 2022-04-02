<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("functions.php");
            include_once("../data/connection.php");
            $menuID = $_POST["menuIDPHP"];
            $href= $_POST["hrefPHP"];
            $title = $_POST["titlePHP"];
            $query = "UPDATE menu SET href = :href, title= :title WHERE menuID = :menuID";
            $prepared = $connection->prepare($query);
            $prepared -> bindParam(":href", $href);
            $prepared -> bindParam(":title", $title);
            $prepared -> bindParam(":menuID", $menuID);
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