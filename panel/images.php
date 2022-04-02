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
                $query = "SELECT * FROM images";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='image' placeholder='assets/upload/image.png'></td>
                <td colspan='2'><input type='button' id='insertImage' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>imageID</td>
                <td class='font-weight-bold'>path</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $connection->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->imageID</td>
                    <td><input type='text' value='$r->path'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteImage' id='$r->imageID' value='Delete'</td>
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