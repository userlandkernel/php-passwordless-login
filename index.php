<?php

function GenerateAuthToken(){
	return bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
}

function Login($pubkeyFile, $signature) {	
    $publicKey = file_get_contents($pubkeyFile);
    $verifyResult = openssl_verify($_SESSION['AuthToken'], base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);
    return $verifyResult;
   
}

// Create a new session
 session_start();
    
// Check if user needs authentication
if (!isset($_SESSION['active'])) {
    
    // Check if the user has a message to sign    
    if (!isset($_SESSION['AuthToken'])) {
        $_SESSION['AuthToken'] = GenerateAuthToken(); // If not generate it
    }
    // Display the token to sign for authentication and the login form
    echo "<strong>Please sign this message: </strong><pre>".$_SESSION['AuthToken']."</pre><br/>";
    echo "<form action='#' method='post'><strong>Enter signature: </strong><input name='signature'><br/><input type='submit'></form>";
 
    // Check if the user posted the signature and has an auth token
     if (isset($_POST['signature']) && isset($_SESSION['AuthToken'])) {
            
        // Perform the signature verification (login)
        if (Login("public.key", $_POST['signature'])){
            $_SESSION['active'] = 1;
            header("Refresh:0");
        }
        else {
            echo "Invalid signature, please try again.";
        }
    }
    
}
// If the session is active
else {
    // Verify the login is succesful
    if($_SESSION['active'] == 1) {
        echo "Logged in!";
        echo "<a href='logout.php'>Log out</a>";
    }
    
}
    
?>
