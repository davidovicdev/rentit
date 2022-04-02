<?php
  session_start();
  include_once("views/header.php");
  include_once("views/navigation.php");
  if(!isset($_SESSION["username"])):
?>
  <!-- LOGIN -->
<div class="container-fluid">
<h1 class="text-center pt-3 text-dark">Log in</h1>
    <div class="row align-items-center justify-content-center min-vh-100">
      <form action="" method="" class="w-50 align-items-center">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" class="form-control"><span class="text-danger" id="usernameError"></span><br>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control text-dark"><span class="text-danger" id="passwordError"></span><br>
        </div>
        <input type="button" id="loginButton" name="loginButton" class="btn btn-dark" value="Log in"><br>
        <span id="wrongTyped" class="text-danger text-center mt-3"></span>
      <h5 class="text-center pt-3 text-dark">You don't have an account yet? Create account <a href='register.php'>here</a></h5>
      </form>
    </div>
</div>
<?php
  endif;
?>
<?php
  if(isset($_SESSION["username"])):
?>
  <div class="container-fluid min-vh-100 text-center">
    <?php if($_SESSION["active"] == 0):
    ?>
    
      <h4 class='text-danger p-5'>Please activate your account</h4>
    
    <?php
    endif;
    ?>
    <?php if($_SESSION["active"]==1):
    ?>
      <h4 class='text-success p-5'>Your account is activated</h4>
    <?php
    endif;
    ?>
    <!-- ALREADY LOGGED IN  -->
    <h1>Hello <?php echo $_SESSION["username"]?></h1>
<?php
  endif;
?>
<?php

if(isset($_SESSION["username"])){
        try{
        echo "<div class='container w-75 text-left'>";
        $username = $_SESSION["username"];
        $query = "SELECT voted FROM users WHERE username = '$username'";
        include_once("data/connection.php");
        include_once("logic/functions.php");
        $voted=$connection->query($query)->fetch();
        if($voted->voted == 0){
          // VOTED
          $query= "SELECT * FROM survey WHERE surveyID = 1";
          $result = $connection ->query($query) ->fetch();
          echo "<p class='h5 font-weight-bold mb-3'>$result->question</p> <br>";
          $query = "SELECT * FROM answers WHERE surveyID = 1";
          $result = $connection ->query($query) ->fetchAll();
          echo "<table class='table'>";
          foreach($result as $res){
            echo("<tr><td class='h6' width='10%'>$res->answerName</td><td class='text-left'><input type='radio' value='$res->answerID' class='text-left' name='answer'></td></tr>");
          }
          echo "</table>";
          echo("<button class='btn btn-dark' id='survey'>See answers</button>");
          echo("<span id='surveyError' class='text-danger ml-5 font-weight-bold'></span>");
        }
        else if($voted->voted == 1){
          // RESULTS OF VOTING
          echo "<p class='h5 font-weight-bold mb-3'>Results of voting</p> <br>";
          $query = "SELECT answerName FROM answers WHERE surveyID = 1";
          $result = $connection ->query($query) ->fetchAll();
          $percents= showPercents(1);
          echo "<table class='table'>";
          for($i = 0; $i<count($result);$i++){
            echo "<tr>";
            echo "<td class='h6' width='10%'>".$result[$i]->answerName."</td>";
            echo "<td class='results text-left'>";
            echo "<div class='bg-primary text-right font-weight-bold pr-1 rounded-right' style='width:".$percents[$i]."%'>".round($percents[$i])."%</div>";
            echo "</td>";
            echo "</tr>";
          }
          echo "</table>";
          echo "<span class='text-danger font-weight-bold' id='surveyError'></span>";
         
        }
        echo"</div>";
      }
      catch(PDOException $e){
        http_response_code(500);
        echo $e->getMessage();
      }
    }
  ?>
</div>
<?php
  include_once("views/showCarsOnIndex.php");
  include_once("views/footer.php");
?>