<?php
    session_start();
    include_once("views/header.php");
    include_once("views/navigation.php");
?>
<div class="container-fluid">
    <div class="row align-items-center justify-content-center min-vh-100">
      <form action="" method="" class="w-50 align-items-center">
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" name="firstName" id="firstName" class="form-control"><span class="text-danger" id="firstNameError"></span><br>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" name="lastName" id="lastName" class="form-control"><span class="text-danger" id="lastNameError"></span><br>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" name="email" id="email" class="form-control"><span class="text-danger" id="emailError"></span><br>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" style="resize:none" id="message" name="message" rows="3"></textarea>
            <span class="text-danger" id="messageError"></span><br>
        </div>
        <input type="button" id="contactButton" name="contactButton" class="btn btn-dark" value="Send"><br>
        <span id="response" class="text-success text-center h6 m-4"></span>
      </form>
    </div>
    
</div>
<?php
    include_once("views/footer.php");
?>