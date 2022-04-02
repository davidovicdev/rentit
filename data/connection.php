<?php
    include_once("data.php");
    try{
        $connection = new PDO("mysql:host=$serverName;dbname=$databaseName",$usernameBase,$passwordBase);
        $connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>