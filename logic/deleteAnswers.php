<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try{
            include_once("../data/connection.php");
            include_once("functions.php");
            $answerID = $_POST["IDPHP"];
            $query= "DELETE FROM answers WHERE answerID = :answerID";
            $prepared = $connection->prepare($query);
            $prepared ->bindParam(":answerID", $answerID);
            $result = $prepared->execute();
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