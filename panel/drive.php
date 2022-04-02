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
                $query = "SELECT * FROM drive";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='driveName' placeholder='Drive'></td>
                <td colspan='2'><input type='button' id='insertDrive' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>driveID</td>
                <td class='font-weight-bold'>name</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $connection->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->driveID</td>
                    <td><input type='text' value='$r->name'></td>
                    <td><input type='button' class='btn btn-dark' name='updateDrive' id='$r->driveID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteDrive' id='$r->driveID' value='Delete'</td>
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