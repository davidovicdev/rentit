<?php
    if(!isset($_SESSION)) 
        { 
        session_start(); 
        } 
        try{
        include_once("logic/functions.php");
        include_once("data/connection.php");
        $query = "SELECT * FROM menu";
        $result = $connection ->query($query)->fetchAll();
        foreach($result as $r){
            if(!isset($_SESSION["username"]) AND $r->href != "logic/logout.php" AND $r->href!="adminPanel.php"){
            echo "<li class='nav-item'><a class='nav-link' href='$r->href'>$r->title</a></li>";
            }
            else if(isset($_SESSION["username"]) AND $_SESSION["roleID"] == 2 AND $r->href =="adminPanel.php"){
            echo "<li class='nav-item'><a class='nav-link' href='$r->href'>$r->title</a></li>";
            }
            else if(isset($_SESSION["username"]) AND ($r->href== "index.php" OR $r->href =="logic/logout.php" OR $r->href=="prices.php" OR $r->href=="about.php" OR $r->href=="contact.php" OR $r->href=="aboutAuthor.php")){
            echo "<li class='nav-item'><a class='nav-link' href='$r->href'>$r->title</a></li>";
            }
        }
        }
        catch(PDOException $e){
        http_response_code(500);
        echo $e->getMessage();
        }
?>