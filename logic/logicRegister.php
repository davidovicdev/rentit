<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("functions.php");
            include_once("../data/connection.php");
            include_once("regex.php");
            $username = $_POST["usernamePHP"];
            $password= $_POST["passwordPHP"];
            $email = $_POST["emailPHP"];
            $firstName = $_POST["firstNamePHP"];
            $lastName = $_POST["lastNamePHP"];
            $survey = 0;
            $roleID = 1;
            $active = 0;
            $code = rand(1000000,9999999);
            check(REGEX_USERNAME,$username,ERROR_USERNAME);
            check(REGEX_PASSWORD,$password,ERROR_PASSWORD);
            check(REGEX_NAMES, $firstName, ERROR_FIRSTNAME);
            check(REGEX_NAMES, $lastName, ERROR_LASTNAME);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors,ERROR_EMAIL);
              }
            if(count($errors) == 0){
                $cryptedPassword = md5($password);
                $result = insertUser($username,$cryptedPassword,$email,$firstName,$lastName,$roleID,$active,$code);
                // sendCode($email,$code);
                if($result){
                    setSessions($username,$cryptedPassword,$email,$firstName,$lastName,$roleID,$active,$survey);
                    echo json_encode($result);
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