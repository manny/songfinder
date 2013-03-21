<?php    
    $dbuser = "web-user";
    $dbpass = "web-pass";
    $database_host = "localhost";
    $database_name = "songfinder";

    $db = new PDO("mysql:host=localhost;dbname=$database_name;charset=utf8", $dbuser, $dbpass); // creates connection object with PDO library
?>
