<?php
    require_once('includes\init.php');
    //Checking if the user is already signed in - if yes, redirecting him to the home page
    if($session->signed_in){
        $_SESSION["Message"] = "You are already logged in, if you want to register again, please sign out first.";
        header('Location:index1.php');
        exit;
    }
    if($_POST){
        //Each variable gets its value from the html form submission
        $userName = $_POST["userName"];
        $password= $_POST["password"];
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $gender = $_POST["SexRadio"];
        $age = $_POST["age"];
        
        //Validation Checks
        $error = "";

        if ( ! $_POST['userName'] ) {
            $error .= "Error:  User Name Field Was Not Filled!\n";
        }
        else{
            $checkUser = new User();
            $response = $checkUser->find_user_by_userName($_POST['userName']);
            if ($response[0]=="found"){
                $error.= "The user name that you entered is already in use! choose another one!\n";
            }
            else{
                if (!(preg_match('/^[a-zA-Z0-9]+$/', $_POST['userName']))) {
                    $error.= "User name should not contains characters other than letters and numbers.\n";
                }
                if(strlen($_POST['userName']) > 8){
                    $error.= "User name must be under 8 character\n";

                }
            }
        }
        if ( ! $_POST['password']) {
            $error .= "Error:  Password Field Was Not Filled!\n";
        }
        else{
            if(strlen($_POST['password']) > 12 ||strlen($_POST['password'] < 8 )){
                $error.= "Password must be between 8 and 12 character\n";

            }
            if (!(preg_match('/[a-z]/', $_POST['password'] ))){
                $error.= " Password must contain at least one small letter\n";
            }
            if (!(preg_match('/[A-Z]/', $_POST['password'] ))){
                $error.= " Password must contain at least one capital letter\n";

            }
        }

        if ( ! $_POST['email']) {
            $error .= "Error:  Email Field Was Not Filled!\n";
        }
        else{
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error.= "Invalid email format";
            }
        }

        if ( ! $_POST['firstName']) {
            $error .= "Error:  First Name Field Was Not Filled!\n";
        }
        else{
            if (!(preg_match('/^[a-zA-Z]+$/', $_POST['firstName']))) {
                $error.= " First name should not contains characters other than letters.\n";
            }
        }

        if ( ! $_POST['lastName']) {
            $error .= "Error:  Last Name Field Was Not Filled!\n";
        }
        else{
            if (!(preg_match('/^[a-zA-Z]+$/', $_POST['lastName']))) {
                $error.= " Last Name should not contains characters other than letters.\n";
            }
        }
        
        if ( ! $_POST['age']) {
            $error .= "Error:  age Field Was Not Filled!\n ";
        }
        else{
            if (!(preg_match('/^[0-9]+$/', $_POST['age']))) {
                $error.= " Age should not contains characters other than numbers.\n";
            }
            else{
                if ($_POST['age'] < 18){
                    $error.= "The registration is from age 18 and above\n";
                }
        }
    }
        //  If the error variable is empty its mean that the registration process ended succssesfully and we can add the answers to the db with the help of the users class
        if($error==""){
            $error1=User::add_user($userName, $password, $email, $firstName, $lastName, $gender, $age);
            if ($error1){
                echo $error1;
            }
            
            else{
                $error="found";
                echo $error;
            }
        }
        else{
            echo $error;
        }
    }
?>
