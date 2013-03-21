<form name = "register" action= "register.php" method = "post">
    username: <input type = "text" name = "username"/><br/>
    password: <input type = "password" name = "password1"/><br/>
    repeat password: <input type = "password" name = "password2"/>
    <input type = "submit" value = "register" />
</form>

<?php
    require("database.php");
function checkUsername($username, $db){
   
    
    $command = "SELECT username FROM users WHERE username=:value"; //string for the command that stmt will execute
    $stmt = $db->prepare($command); //prepare creates object from string
    $stmt->bindParam(':value', $username); // puts variable $ in placeholder : while checking for string escape bs
    if (!$stmt->execute()) {   //executes the command from the string. returns boolean
        echo "Database is down. Try again later";
        exit;
    }
    $results = $stmt->fetchAll();  //returns all the results from the command
    if(count($results)==0){  //checks how many results where returned. returns 1 or 0
        return true;     
    }else{
        return false;
    }

}
function registerUser($username, $password, $db){
    $command = "INSERT INTO users VALUES(:username, :password)"; // :variable acts as placeholder for $variable
    $stmt = $db->prepare($command);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    if(!$stmt->execute()){             
        echo "Database is down. Try again later"; // if connection is down or syntax in command is wrong
        exit;
    }
    return true;
}

if(isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"])){
    $username = $_POST["username"];
    $password1 = $_POST["password1"];
    $password2 =  $_POST["password2"];
    
    if($password1 != $password2){
        echo "Your passwords do not match. Try again";
        exit;
    }
    $hashword = md5($password1); // hashes password
    global $db;
    if(checkUsername($username, $db)){
        registerUser($username, $hashword, $db);
        echo "Registration Successful";

    }else{
        echo "Cannot register with a taken username";
        exit;
    }
}
?>

