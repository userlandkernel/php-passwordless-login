<?php 
/* Example authenticated page */
    include_once("login.func.php");

    if(!defined('RSALoginVersion')) {
       die('Direct access not permitted');
    }

 include_once("login.func.php");
 if (CheckAuthenticated()){
?>    
<div class="container">
    <h1>Welcome</h1>
    <div class="card">
      <h5 class="card-header">Running a minecraft server safely in docker</h5>
      <div class="card-body">
        <h5 class="card-title">How to setup a secure minecraft server in docker on Linux</h5>
        <p class="card-text">Running a minecraft server on local LAN can put your network at risk, learn how to isolate the server from your network.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
<?php
}
?>
