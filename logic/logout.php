<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["email"]);
    unset($_SESSION["firstName"]);
    unset($_SESSION["lastName"]);
    header("Location: ../index.php");
?>
