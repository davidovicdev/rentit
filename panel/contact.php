<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION["username"]) OR $_SESSION["roleID"] != 2){
            http_response_code(404);
        }
        if(isset($_SESSION["username"]) AND $_SESSION["roleID"] == 2){
            try{
                include_once("../logic/functions.php");
                include_once("../data/connection.php");
                $query = "SELECT * FROM contact";
                $return = "
                <tr>
                <td class='font-weight-bold'>contactID</td>
                <td class='font-weight-bold'>firstName</td>
                <td class='font-weight-bold'>lastName</td>
                <td class='font-weight-bold'>email</td>
                <td class='font-weight-bold'>message</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $connection->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->contactID</td>
                    <td>$r->firstName</td>
                    <td>$r->lastName</td>
                    <td>$r->email</td>
                    <td>$r->message</td>
                    <td><input type='button' class='btn btn-dark' name='deleteContact' id='$r->contactID' value='Delete'</td>
                    </tr>";
                }
                echo json_encode($return);
            }
            catch(PDOException $e){
                http_response_code(500);
                echo $e->getMessage();
            }
        }
    }
    else{
        http_response_code(404);
    }
    
?>