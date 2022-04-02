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
                $query = "SELECT * FROM answers";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='answerName' placeholder='Answer Name'></td>
                <td><input type='text' id='votes' placeholder='Votes'></td>
                <td><input type='text' id='surveyID' placeholder='surveyID'></td>
                <td colspan='2'><input type='button' id='insertAnswer' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>answerID</td>
                <td class='font-weight-bold'>answerName</td>
                <td class='font-weight-bold'>Votes</td>
                <td class='font-weight-bold'>surveyID</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $connection->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->answerID</td>
                    <td><input type='text' value='$r->answerName'></td>
                    <td><input type='text' value='$r->votes'></td>
                    <td>$r->surveyID</td>
                    <td><input type='button' class='btn btn-dark' name='updateAnswer' id='$r->answerID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteAnswer' id='$r->answerID' value='Delete'</td>
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