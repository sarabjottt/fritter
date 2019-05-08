<?php
/* This will insert the post into Database */
session_start();
require 'db.php';
date_default_timezone_set("Australia/Melbourne");
$article = $_POST["article"];
if(isset($_POST['submit']))
            {
               // Putting data from form into variables to be manipulated
               
               $article = $_POST['article'];

               // Getting the form variables and then placing their values into the MySQL table
               echo "INSERT INTO post (text, user_id) values ('".$article."','".$_SESSION['id']."')";
               $mysqli ->query("INSERT INTO post (text, user_id, post_date) values ('".$article."','".$_SESSION['id']."','".date('Y-m-d H:i:s')."') ");
    
            }
            header("location: profile.php");
?>