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
                $query = "SELECT * FROM menu";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='href' placeholder='href'></td>
                <td><input type='text' id='title' placeholder='title'></td>
                <td colspan='2'><input type='button' id='insertMenu' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>menuID</td>
                <td class='font-weight-bold'>href</td>
                <td class='font-weight-bold'>title</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $connection->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->menuID</td>
                    <td><input type='text' value='$r->href'></td>
                    <td><input type='text' value='$r->title'></td>
                    <td><input type='button' class='btn btn-dark' name='updateMenu' id='$r->menuID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteMenu' id='$r->menuID' value='Delete'</td>
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