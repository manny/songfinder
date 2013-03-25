<!DOCTYPE html>

<html>
    <head>
        <title>SongFinder</title>
        <link type = "text/css" rel = "stylesheet" href = "stylesheet.css"/>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script  type = "text/javascript" src = "script.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   </head>
    <h2>
       <em>Songfinder</em>
    </h2>
    <body>
        
        <form ID = "uploadForm" enctype = "multipart/form-data" action="uploader.php" method="POST">
        UPLOAD A SONG FILE TO IDENTIFY</br> <input name="uploadfile" type="file" />
        <input type="submit" value="Upload File" />
        </form>
        <img src= "http://dribbble.s3.amazonaws.com/users/3311/screenshots/711774/screen_shot_2012-08-30_at_11.35.23_pm.png" /></br>
        <a href = "register.php"><strong>Register</strong></a>
        </br> 
        <?php
            session_start();  // creates session array(kinda like POST) that can save  variables between pages
            if(isset($_SESSION['username'])){
                echo  " Hello " . $_SESSION['username']; // use "." 
        ?>
                    <form name = "logout" action= "login.php" method = "post">  <!-- form name doesnt matter, action tells it where to go\--> 
                    <input type = "submit" name = "logoutButton" value = "logout" /> <!-- name is index in POST array. value shows what appears on button-->

         <?php
            }else{
        
                if(isset($_SESSION['loginFail'])){    
                    echo $_SESSION['loginFail'] ."<br/>";  //triggers when user inputs invalid username/password
                    echo  "login fail";
                    unset($_SESSION['loginFail']);
                    
                }
         ?>
        </br>
        <form name = "login" action= "login.php" method = "post">
        Username: <input type = "text" name = "username"/></br>
        Password: <input type = "password" name = "password"/></br>
        <input type = "submit" value = "Login" />
        </form>
        <?php
           }
        ?>

    </body>
</html>
