<?php
    session_start();
    unset($_SESSION["active"]);
    unset($_SESSION["AuthToken"]);
    header("location: /");
    session_destroy();
?>
