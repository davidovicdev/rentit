<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- BOOTSTRAP -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    
    <!-- FONT AWESOME  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
      integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
      crossorigin="anonymous"
    /> 
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <?php
        if(!isset($_SESSION["username"]) AND $_SERVER["PHP_SELF"] == '/sajt/index.php'):
    ?>
    <title>Log in</title>
    <?php
        
        endif;
    ?>
    <?php
        if(isset($_SESSION["username"]) AND $_SERVER["PHP_SELF"] == '/sajt/index.php'):
            ?>
        <title>Home page</title>
        <?php
        endif;
    ?>
    <?php if($_SERVER["PHP_SELF"] == '/sajt/about.php'):
    ?>
      <title>About us</title>
    <?php
      endif;
    ?>
    <?php if($_SERVER["PHP_SELF"] == '/sajt/aboutAuthor.php'):
    ?>
      <title>About Author</title>
    <?php
      endif;
    ?>
    <?php if($_SERVER["PHP_SELF"] == '/sajt/contact.php'):
    ?>
      <title>Contact</title>
    <?php
      endif;
    ?>
    <?php if($_SERVER["PHP_SELF"] == '/sajt/prices.php'):
    ?>
      <title>Prices</title>
    <?php
      endif;
    ?>
    <?php if($_SERVER["PHP_SELF"] == '/sajt/register.php'):
    ?>
      <title>Register</title>
    <?php
      endif;
    ?>
     <?php if($_SERVER["PHP_SELF"] == '/sajt/rentCar.php'):
    ?>
      <title>Rent Car</title>
    <?php
      endif;
    ?>
  </head>
  <body>