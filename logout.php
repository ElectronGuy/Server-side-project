<?php
    require_once('includes/init.php');
    // If the user not sign in write a message
    if($session->signed_in==false){
        $_SESSION["Message"] = "You are not logged in!";
    }
    // If you are log in so write a message
    else{
        $_SESSION["Message"] = "You have have been logged out successfully, please log in again to watch any content!";
    }
    // Any way, go to log in page and log out
    $session->logout();
    header('Location: loginFront.php');
    exit;
?>