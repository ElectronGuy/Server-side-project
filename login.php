<?php
    require_once('includes\init.php');
    $info ='';
    if(isset($_POST['submit'])){
        //Each variable gets its value from the html form submission
        $userName = $_POST["userName"];
        $password= $_POST["password"];
        $user = new User();

        // Validate the datails that the user enter in the login procces
        $error = User::validateLogin($password,$userName);
        if ($error=="found"){
            $info= "found";
            $session->login($userName);
        }
        else{
            $info = $error;
        }
        echo $info;
    }
?>

