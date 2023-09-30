<?php
define('RSALoginVersion', "1.0-beta");

include_once("login.func.php");
include_once("db.func.php");

/*
    MAIN LOGIN LOGIC
*/
if(!isset($_SESSION)) {
 session_start();
}
    
if (!CheckAuthenticated()) {
    if (isset($_POST["username"]) && isset($_POST["signature"])) {
        $_SESSION["USERNAME"] = $_POST['username']; 
    
        if ( GetUserData() ) {
            if(AuthenticateRSA($_SESSION["PUBKEY"], $_POST["signature"])) {
                $_SESSION["active"] = 1;
                header("Refresh:0"); // Reload page to be logged in
            }
            else {
                echo "Invalid signature";
            }
        } else {
            echo $_SESSION["error"];
        }
    
        
    }
    else {
        // Display the token to sign for authentication and the login form
      include_once("login.view.php");
    }
} else {
    echo "Logged in!";
    echo "<a href='logout.php'>Log out</a>";
}
       
?>
