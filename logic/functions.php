<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $errors = array();
    function check($regex, $input, $error){
        if(!isset($input) or empty($input) or !preg_match($regex,$input)){
            array_push($errors, $error);
        }
    }
    function insertUser($username,$cryptedPassword,$email,$firstName,$lastName,$roleID,$active,$code, $voted = 0){
        global $connection;
        $query = "INSERT INTO users VALUES (null,:user,:password,null,:email,:firstName,:lastName,:roleID, :active, :code, 0)";
        $prepared = $connection -> prepare($query);
        $prepared -> bindParam(":user", $username);
        $prepared -> bindParam(":password", $cryptedPassword);
        $prepared -> bindParam(":email", $email);
        $prepared -> bindParam(":firstName", $firstName);
        $prepared -> bindParam(":lastName", $lastName);
        $prepared -> bindParam(":roleID", $roleID);
        $prepared -> bindParam(":active", $active);
        $prepared -> bindParam(":code", $code);
        $result = $prepared -> execute();
        return $result;
        
    }
    function setSessions($username,$password,$email,$firstName,$lastName,$roleID,$active){
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $_SESSION["email"] = $email;
        $_SESSION["firstName"] = $firstName;
        $_SESSION["lastName"] = $lastName;   
        $_SESSION["roleID"] = $roleID;
        $_SESSION["active"] = $active;
    }
    function insertContact($firstName,$lastName,$email,$message){
        global $connection;
        $query = "INSERT INTO contact VALUES(null, :firstName,:lastName, :email,:message)";
        $prepared = $connection ->prepare($query);
        $prepared ->bindParam(":firstName", $firstName);
        $prepared ->bindParam(":lastName", $lastName);
        $prepared ->bindParam(":email", $email);
        $prepared ->bindParam(":message", $message);
        $result = $prepared ->execute();
        return $result;
    }
    function insertUsersCars($userID, $carID, $beginDate, $endDate,$totalPrice){
        global $connection;
        $query = "INSERT INTO users_cars VALUES (null, :userID, :carID, :beginDate, :endDate, :totalPrice)";
        $prepared = $connection->prepare($query);
        $prepared ->bindParam(":userID", $userID);
        $prepared ->bindParam(":carID", $carID);
        $prepared ->bindParam(":beginDate", $beginDate);
        $prepared ->bindParam(":endDate", $endDate);
        $prepared ->bindParam(":totalPrice", $totalPrice);
        $result = $prepared ->execute();
        return $result;
    }
     function updateSurvey($answerID,$username){
         global $connection;
         $query = "UPDATE answers SET votes = votes + 1 WHERE answerID = :answerID";
         $prepared = $connection -> prepare($query);
         $prepared ->bindParam(":answerID", $answerID);
         $result = $prepared ->execute();
         $query = "UPDATE users SET voted = 1 WHERE username=:username";
         $prepared = $connection->prepare($query);
         $prepared ->bindParam(":username", $username);
         $prepared ->execute();
         return $result;
     }
     function showPercents($surveyID){
         global $connection;
         $percents = [];
         $query = "SELECT * , (SELECT (ROUND(a.votes/SUM(votes),2)*100) FROM answers) as percentage FROM answers a WHERE surveyID = :surveyID";
         $prepared = $connection ->prepare($query);
         $prepared ->bindParam(":surveyID", $surveyID);
         $prepared ->execute();
         $result = $prepared ->fetchAll();
         foreach($result as $res){
             array_push($percents , $res->percentage);
         } 
         return $percents;
     }
     function showMenu(){
         global $connection;
         $query = "SELECT * FROM menu";
         $result = $connection->query($query) ->fetchAll();
         foreach($result as $r){
             echo"<li class='nav-item active'>";
             if(!isset($_SESSION["username"]) AND ($r->href == "login.php" OR $r->href== "register.php")){
                 echo "<a class='nav-link' href='$r->href'>$r->title</a>";
             }
             else if(isset($_SESSION["username"]) AND $r->href =="logic/logout.php"){
                 echo "<a class='nav-link' href='$r->href'>$r->title</a>";
             }
             else if(isset($_SESSION["username"]) AND $_SESSION["roleID"] == 2 AND $r->href=="adminPanel.php"){
                 echo "<a class='nav-link' href='$r->href'>$r->title</a>";
             }
      
             echo"</li>";
         }
     }
     //ADMIN PANEL
     function showTable($ID){
         global $connection;
         $query = "SELECT * FROM $ID";
         $result = $connection->query($query)->fetchAll();
         return $result;
     }
     function sendCode($email,$code){
        $headers = array(
            'From' => 'webmaster@example.com',
            'Reply-To' => 'webmaster@example.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );
         $message = "Please verify your account on http://www.rentit.com/sajt using this <a href='http://localhost/sajt/logic/logicVerify.php?email=$email&code=$code'>link</a>";
         mail("matija.davidovic.115.18@ict.edu.rs","Verification mail", $message, $headers);
     }
?>