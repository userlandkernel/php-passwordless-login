<?php
include_once("login.func.php");
if (!isset($_SESSION)) {
    session_start();
}

class User
{
    public $ID;
    public $AuthToken;
    public $username;

    public function __construct()
    {
        
    }
    
}

function GetUserData() {
    
    // Database configuration (Change this to your own)
    $servername = "localhost";
    $username = "johndoe";
    $password = "secretpassword"; 
    $dbname = "rsalogin_users";

    try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Check if $_POST['username'] is set
            if (isset($_SESSION['USERNAME'])) {
                // Sanitize the input
                $uname = filter_var($_SESSION['USERNAME'], FILTER_SANITIZE_STRING);
        
                // Prepare the SQL statement
                $stmt = $conn->prepare("SELECT ID, AuthToken, username FROM user WHERE username = :username LIMIT 1");
        
                // Bind the parameter
                $stmt->bindParam(':username', $uname, PDO::PARAM_STR);
        
                // Execute the statement
                $stmt->execute();
        
                // Fetch the results
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                
                $person = $stmt->fetch();
                
                if(empty($person)){
                    $_SESSION["error"] = "Username not found";
                
                    return false;
                }
                $_SESSION["USERID"] = $person->ID;
                $_SESSION["USERNAME"] = $person->username;
                $_SESSION["PUBKEY"] = $person->AuthToken;
                return true;
            }
    
        } catch(PDOException $e) {
            $_SESSION["error"] = "Connection failed: " . $e->getMessage();
            return false;
        }
            
    // Close the database connection
    $conn = null;
    
}


?>
