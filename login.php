<?php
    require("database.php");
    session_start();
    if(!isset($_POST["username"])){
        header("Location: http://jsedlacek.info/~mjl288/songfinder/index.php");
    }
    if(isset($_POST["logoutButton"])){
        unset($_SESSION["username"]);
        unset($_SESSION['loginFail']);
        unset($_POST['logoutButton']);
        header("Location: http://jsedlacek.info/~mjl288/songfinder/index.php");
    }else{

        $command = "SELECT username FROM users WHERE username=:value AND hash=:hashword"; //string for the command that stmt will execute
        $stmt = $db->prepare($command); //prepare creates object from string
        $stmt->bindParam(':value', $_POST["username"]);
        $stmt->bindParam(':hashword', md5($_POST["password"]));
        echo md5($_POST["password"]);
        if (!$stmt->execute()) {   //executes the command from the string. returns boolean
            echo "Database is down. Try again later";
            exit;
        }
        $results = $stmt->fetchAll();  //returns all the results from the command
        if(count($results)==1){  //checks how many results where returned
            $_SESSION['username'] = $_POST['username'];
        }else{
            $_SESSION['loginFail'] = "Incorrect login information"; // in index.php if user isnt login and loginFail is set, print message and unset

        }
        header("Location: http://jsedlacek.info/~mjl288/songfinder/index.php");
    }
?> 
