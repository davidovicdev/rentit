<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!isset($_SESSION)){
            session_start();
        }
        try{
            include_once("functions.php");
            include_once("../data/connection.php");
            include_once("regex.php");
            $survey = 0;
            $username = $_POST["usernamePHP"];
            $password= $_POST["passwordPHP"];
            check(REGEX_USERNAME,$username,ERROR_USERNAME);
            check(REGEX_PASSWORD,$password,ERROR_PASSWORD);
            if(count($errors) == 0){
                
                $cryptedPassword = md5($password);
                $query = "SELECT * FROM users WHERE username = :user AND password = :password";
                $prepared = $connection -> prepare($query);
                $prepared -> bindParam(":user", $username);
                $prepared -> bindParam(":password", $cryptedPassword);
                $prepared -> execute();
                $result = $prepared ->fetch();
                if($result){
                    setSessions($username,$cryptedPassword,$result->email,$result->firstName,$result->lastName, $result->roleID, $result->active);
                    echo json_encode(1);
                }
                else{
                    echo json_encode(0);
                }
            }
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