<?php

require_once('includes/init.php');
require_once('preferencesClass.php');

//Check if the user is signed in
if(!$session->signed_in){
    $_SESSION["Message"] = "You have to be logged in to fill our survey or watch the stats!Please log in";
    header('Location:loginFront.php');
    exit;
}

if($_POST){
    
    //Each variable gets its value from the html form submission
    $location = $_POST["location"];
    $frequency= $_POST["frequency"];
    $genre = $_POST["genre"];
    $platform = $_POST["platform"];
    $companion = $_POST["companion"];
    $length = $_POST["length"];
    $format = $_POST["format"];
    $influence = $_POST["influence"];
    $languageRadio = $_POST["languageRadio"];
    $status = $_POST["status"];
    
    if($status=="save"){
        if(Preference::findUser($_SESSION["userName"])=="found"){
            $error1=Preference::update_preference($location, $frequency, $genre,
            $languageRadio, $platform, $companion, $length, $format, $influence,$status, $_SESSION["userName"]);
            // if there is error ocurred in the add-perferences function show us thwe error
            if ($error1){
                $error=$error1;
                echo $error;
            }
            // if there is no error tell the user that the survey was submitted
            else{
                $error="success";
                echo $error;
            }
        }
        else{
            $error1=Preference::add_preference($location, $frequency, $genre,
            $languageRadio, $platform, $companion, $length, $format, $influence,$status, $_SESSION["userName"]);
            // if there is error ocurred in the add-perferences function show us thwe error
            if ($error1){
                $error=$error1;
                echo $error;
            }
            // if there is no error tell the user that the survey was submitted
            else{
                $error="success";
                echo $error;
            }
        }
    }
    else{
        //Validation Checks in case the user wants to submit the form.
        $error = "";
        if($_POST['location'] == "Select"){
            $error =  "Location, ";
        }
        if($_POST['frequency'] == "Select"){
            $error = $error. "Frequency, ";
        }
        if($_POST['genre'] == "Select"){
            $error = $error. "Genre, ";
        }
        if($_POST['platform'] == "Select"){
            $error = $error. "Platform, ";
        }
        if($_POST['companion'] == "Select"){
            $error = $error. "Companion, ";
        }
    
        if($_POST['length'] == "Select"){
            $error = $error. "Length, ";
        }
        if($_POST['format'] == "Select"){
            $error = $error. "Format, ";
        }
        if($_POST['influence'] == "Select"){
            $error = $error. "Influence, ";
        }
        if($_POST['languageRadio'] == "Select"){
            $error = $error. "LanguageRadio, ";
        }

        // If the error variable is empty its mean that there is no erroe and we can add the answers to the db with the help of the preferences class
        if($error==""){
            if(Preference::findUser($_SESSION["userName"])=="found"){
                $error1=Preference::update_preference($location, $frequency, $genre,
                $languageRadio, $platform, $companion, $length, $format, $influence,$status, $_SESSION["userName"]);
                // if there is error ocurred in the add-perferences function show us thwe error
                if ($error1){
                    $error=$error1;
                    echo $error;
                }
                // if there is no error tell the user that the survey was submitted
                else{
                    $error="success";
                    echo $error;
                }
            }
            else{
                $error1=Preference::add_preference($location, $frequency, $genre,
                $languageRadio, $platform, $companion, $length, $format, $influence,$status, $_SESSION["userName"]);
                // if there is error ocurred in the add-perferences function show us thwe error
                if ($error1){
                    $error=$error1;
                    echo $error;
                }
                // if there is no error tell the user that the survey was submitted
                else{
                    $error="success";
                    echo $error;
                }
            }
        }
        // If error is not empty there is some error that we need to unteduce to the user
        else{
            $error=$error. "Fields must be filled!";
            echo $error;
        }
    }
}
?>
