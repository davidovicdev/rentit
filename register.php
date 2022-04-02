<?php
  session_start();
  include_once("views/header.php");
  include_once("views/navigation.php");
  
?>
<?php
    if(isset($_SESSION["username"])){
        header("Location: index.php");
    }
    if(!isset($_SESSION["username"])):
?>
<div class="container-fluid">
  <h1 class="text-center pt-3 text-dark">Registration</h1>
    <div class="row align-items-center justify-content-center min-vh-100 p-3">
      <form action="" method="" class="w-50">
      <div class="form-group">
        <label for="firstName">First Name:</label>
        <input class="form-control" placeholder="Johnny" type="text" name="firstName" id="firstName"><span class="text-danger" id="firstNameError"></span><br>
      </div>
      <div class="form-group">
      <label for="lastName">Last Name:</label>
        <input class="form-control" placeholder="Smith" type="text" name="lastName" id="lastName"><span class="text-danger" id="lastNameError"></span><br>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="text" placeholder="john123@gmail.com" name="email" id="email"><span class="text-danger" id="emailError"></span><br>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input class="form-control" type="text" placeholder="johnnyKing123" name="username" id="username"><span class="text-danger" id="usernameError"></span><br>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input class="form-control" type="password" name="password" id="password"><span class="text-danger" id="passwordError"></span><br>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"><span class="text-danger" id="confirmPasswordError"></span><br>
      </div>
        
        <input type="button" id="registerButton" class="btn btn-dark" name="registerButton" value="Register">
        <input type="reset" id="resetButton" class="btn btn-dark" name="reset" value="Reset">
        <h5 class="text-center pt-3 text-dark">You already have a account? Log in <a href='index.php'>here</a></h5>
      </form>
    </div>
</div>
<?php
  endif;
?>

<?php
  include_once("views/footer.php");
?>