<?php
function GenerateAuthToken(){
	return bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
}

function AuthenticateRSA($pubkeyFile, $signature) {	
    $publicKey = file_get_contents($pubkeyFile);
    echo $publicKey;
    $verifyResult = openssl_verify($_SESSION['AuthToken'], base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);
    return $verifyResult;
   
}
function CheckAuthenticated() {
    if (!isset($_SESSION['active'])) {
        return false;
    }
    else {
        if ($_SESSION['active'] == 1) {
            return true;
        }
    }
}

function GetAuthtoken() {
    
    if (!isset($_SESSION["AuthToken"]) ) {
        $_SESSION["AuthToken"] = GenerateAuthToken();
    }
    return $_SESSION["AuthToken"];
}

?>
