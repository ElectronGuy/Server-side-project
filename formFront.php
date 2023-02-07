<?php
    require_once('includes/init.php');
    require_once('preferencesClass.php');

    //Check if the user is signed in
    if(!$session->signed_in){
        $_SESSION["Message"] = "You have to be logged in to fill our survey or watch the stats!Please log in";
        header('Location:loginFront.php');
        exit;
    }
    
    else{
        global $preference;
        $userName = $_SESSION['userName'];
        global $find;
        //Checking if the user has already saved or submitted his answers!
        $find = Preference::findUser($userName);
        if($find=="found"){
            $status = Preference::findStatusForUser($userName);
            if($status=="done"){
                $_SESSION["Message"] = "You have already filled the survey! Redirecting you to the stats page!";
                header('Location:stats.php');
            }
            else{
                $preference = Preference::getPreferencesForUser($userName);
            }
        }
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Survey Page</title>
    <style>
        .form-body{
            width:600px;
            margin:auto;
            background-color: #f8f8f8; /* Light gray background color */
            border: 5px solid #ffa500; /* Orange border */
            border-radius: 10px; /* Rounded corners */
            font-size: 16px; /* Larger font size */
            font-family: Arial, sans-serif; /* Arial font */
            color: #333; /* Dark gray text color */
            padding: 20px; /* Some padding inside the form */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Shadow effect */
            text-align: center; /* Center-align the text */
            margin: auto; /* Center the form on the page */
            margin-top:20px;
        }
        .someMargin{
            margin-top: 8px;
        }
        nav {
            background-color: #333; /* Dark gray background color */
            height: 50px; /* Set the height of the navbar */
            display: flex; /* Use flexbox layout */
            align-items: center; /* Center the navbar items vertically */
            justify-content: space-between; /* Distribute the navbar items evenly across the width of the navbar */
            }
 
        nav ul {
        list-style: none; /* Remove the bullets from the list */
        margin: 0; /* Remove the default margin */
        padding: 0; /* Remove the default padding */
        display: flex; /* Use flexbox layout */
        }
        
        nav li {
        display: inline-block; /* Display the list items as inline blocks */
        }
        
        nav a {
        display: block; /* Display the links as blocks */
        text-decoration: none; /* Remove the underline from the links */
        color: #fff; /* White text color */
        padding: 0 20px; /* Add some padding to the links */
        }
        
        nav a:hover {
        background-color: #ffa500; /* Orange background color on hover */
        color: #333; /* Dark gray text color on hover */
        }
        .nav-item-user-name {
            color: orange;
            margin-right: 30px;
            padding-left: 30px;
  
         }
    </style>
</head>
 
<body>
<nav>
    <ul>
        <li class='nav-item-user-name'><?php echo "Hello, ".$_SESSION['userName'] ?></li>
        <li><a href="index1.php">Home</a></li>
        <li><a href="formFront.php">Survey</a></li>
        <li><a href="actors.php">Actors&Movies</a></li>
        <li><a href="top100.php">IMDB Top 100</a></li>
        <li><a href="registrationFront.php">Registration</a></li>
        <li><a href="logout.php">Sign Out</a></li>
    </ul>
    </nav>
    <div class="form-body">
        <h1>Movies World Preferences Survey! Welcome</h1>
        <form method = "POST"> 
        <div class="form-group">
            <label for="location">Where do you prefer to watch movies?</label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $home = '<option value="Home">Home</option>';
                        $theatre = '<option value="Theatre">Theatre</option>';
                        $drivein ='<option value="Drive-In">Drive-In</option>';
                        $select ='<option value="Select">Select an Option</option>';
                        if($preference->location=="Home"){
                            $home = '<option value="Home" selected>Home</option>';
                        }
                        if($preference->location=="Theatre"){
                            $theatre = '<option value="Theatre" selected>Theatre</option>';
                        }
                        if($preference->location=="Drive-In"){
                            $drivein ='<option value="Drive-In" selected>Drive-In</option>';
                        }
                        if($preference->location=="Select"){
                            $select ='<option value="Select">Select an Option</option>';
                        }
                        echo '<select class="form-control" id="location" name="location">';
                        echo $select;
                        echo $home;
                        echo $drivein;
                        echo $theatre;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="location" name="location">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Home">Home</option>';
                        echo '<option value="Theatre">Theatre</option>';
                        echo '<option value="Drive-In">Drive-In</option>';
                        echo '</select>';
                        }
                        
                ?>
        </div>
        <div class="form-group">
            <label for="frequency">How often do you watch movies?</label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $weekly = '<option value="Weekly">Weekly</option>';
                        $monthly = '<option value="Monthly">Monthly</option>';
                        $yearly='<option value="Yearly">Yearly</option>';
                        $select ='<option value="Select">Select an Option</option>';
                        if($preference->frequency=="Weekly"){
                            $weekly = '<option value="Weekly" selected>Weekly</option>';
                        }
                        if($preference->frequency=="Monthly"){
                            $monthly = '<option value="Monthly" selected>Monthly</option>';
                        }
                        if($preference->frequency=="Yearly"){
                            $yearly='<option value="Yearly" selected>Yearly</option>';
                        }
                        if($preference->frequency=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="frequency" name="frequency">';
                        echo $select;
                        echo $weekly;
                        echo $monthly;
                        echo $yearly;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="frequency" name="frequency">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Weekly">Weekly</option>';
                        echo '<option value="Monthly">Monthly</option>';
                        echo '<option value="Yearly">Yearly</option>';
                        echo '</select>';
                        }
 
                ?>
        </div>
        <div class="form-group">
            <label for="genre">What is the movie genre you like the most?</label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $horror = '<option value="Horror">Horror</option>';
                        $comedy = '<option value="Comedy">Comedy</option>';
                        $drama='<option value="Drama">Drama</option>';
                        $fantasy='<option value="Fantasy">Fantasy</option>';
                        $scifi = '<option value="SciFi">SciFi</option>';
                        $doco = '<option value="Doco">Doco</option>';
                        $action = '<option value="Action">Action</option>';
                        $thriller= '<option value="Thriller">Thriller</option>';
                        $select ='<option value="Select">Select an Option</option>';
                        if($preference->genre=="Horror"){
                            $horror = '<option value="Horror" selected>Horror</option>';
                        }
                        if($preference->genre=="Comedy"){
                            $comedy = '<option value="Comedy" selected>Comedy</option>';
                        }
                        if($preference->genre=="Drama"){
                            $drama='<option value="Drama" selected>Drama</option>';
                        }
                        if($preference->genre=="Fantasy"){
                            $fantasy='<option value="Fantasy" selected>Fantasy</option>';
                        }
                        if($preference->genre=="SciFi"){
                            $scifi = '<option value="SciFi" selected>SciFi</option>';
                        }
                        if($preference->genre=="Doco"){
                            $doco = '<option value="Doco" selected>Doco</option>';
                        }
                        if($preference->genre=="Action"){
                            $action = '<option value="Action" selected>Action</option>';
                        }
                        if($preference->genre=="Thriller"){
                            $thriller= '<option value="Thriller" selected>Thriller</option>';
                        }
                        if($preference->genre=="Selected"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="genre" name="genre">';
                        echo $select;
                        echo $horror;
                        echo $comedy;
                        echo $drama;
                        echo $fantasy;
                        echo $scifi;
                        echo $doco;
                        echo $action;
                        echo $thriller;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="genre" name="genre">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Horror">Horror</option>';
                        echo '<option value="Comedy">Comedy</option>';
                        echo '<option value="Drama">Drama</option>';
                        echo '<option value="Fantasy">Fantasy</option>';
                        echo '<option value="SciFi">SciFi</option>';
                        echo '<option value="Doco">Doco</option>';
                        echo '<option value="Action">Action</option>';
                        echo '<option value="Thriller">Thriller</option>';
                        echo '</select>';
                        }
 
                ?>
 
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">Do you prefer watching movies in their original language? </label>
        </div>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                global $yes;
                global $no;
                if($find=="found"){
                    if($preference->language=="yes"){
                        $yes = '<input class="form-check-input" type="radio" name="languageRadio" id="languageYesOption" value="yes" checked>';
                        $no = '<input class="form-check-input" type="radio" name="languageRadio" id="languageNoOption" value="no">';
                    }
                    else{
                        $yes = '<input class="form-check-input" type="radio" name="languageRadio" id="languageYesOption" value="yes">';
                        $no = '<input class="form-check-input" type="radio" name="languageRadio" id="languageNoOption" value="no" checked>';
                    }
                }
                else{
                    $yes = '<input class="form-check-input" type="radio" name="languageRadio" id="languageYesOption" value="yes" checked>';
                    $no = '<input class="form-check-input" type="radio" name="languageRadio" id="languageNoOption" value="no">';
                }
            ?>
        <div class="form-check-inline">
            <?php echo $yes;
            ?>
            <label class="form-check-label" for="exampleRadios1">
                Yes
            </label>
        </div>
        <div class="form-check-inline">
            <?php echo $no;
            ?>
            <label class="form-check-label" for="exampleRadios2">
                No
            </label>
        </div>

        <div class="form-group someMargin">
            <label for="platform">In what platform do you watch movies the most?<br></label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $netflix ='<option value="Netflix">Netflix</option>';
                        $cables='<option value="Cables">Cables</option>';
                        $cinema='<option value="Cinema">Cinema</option>';
                        $internet = '<option value="Internet">Internet</option>';
                        $other = '<option value="Other">Other</option>';
                        $select ='<option value="Select">Select an Option</option>';
                        if($preference->platform=="Netflix"){
                            $netflix ='<option value="Netflix" selected>Netflix</option>';
                        }
                        if($preference->platform=="Cables"){
                            $cables='<option value="Cables" selected>Cables</option>';
                        }
                        if($preference->platform=="Cinema"){
                            $cinema='<option value="Cinema" selected>Cinema</option>';
                        }
                        if($preference->platform=="Internet"){
                            $internet = '<option value="Internet" selected>Internet</option>';
                        }
                        if($preference->platform=="Other"){
                            $other = '<option value="Other" selected>Other</option>';
                        }
                        if($preference->platform=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="platform" name="platform">';
                        echo $select;
                        echo $netflix;
                        echo $cables;
                        echo $cinema;
                        echo $internet;
                        echo $other;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="platform" name="platform">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Netflix">Netflix</option>';
                        echo '<option value="Cables">Cables</option>';
                        echo '<option value="Cinema">Cinema</option>';
                        echo '<option value="Internet">Internet</option>';
                        echo '<option value="Other">Other</option>';
                        echo '</select>';
                        }    
                ?>
        </div>

        <div class="form-group">
            <label for="influence">What factors influence your decision to watch a particular movie?<br></label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $reviews = '<option value="Reviews">Reviews</option>';
                        $trailers = '<option value="Trailers">Trailers</option>';
                        $recommendation ='<option value="Recommendations">Recommendations</option>';
                        $other = '<option value="Other">Other</option>';
                        $select ='<option value="Select">Select An Option</option>';
                        if($preference->influence=="Reviews"){
                            $reviews = '<option value="Reviews" selected>Reviews</option>';
                        }
                        if($preference->influence=="Trailers"){
                            $trailers = '<option value="Trailers" selected>Trailers</option>';
                        }
                        if($preference->influence=="Recommendation"){
                            $recommendation ='<option value="Recommendations" selected>Recommendations</option>';
                        }
                        if($preference->influence=="Other"){
                            $other = '<option value="Other" selected>Other</option>';
                        }
                        if($preference->influence=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="influence" name="influence">';
                        echo $select;
                        echo $reviews;
                        echo $trailers;
                        echo $recommedation;
                        echo $other;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="influence" name="influence">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Reviews">Reviews</option>';
                        echo '<option value="Trailers">Trailers</option>';
                        echo '<option value="Recommendations">Recommendations</option>';
                        echo '<option value="Other">Other</option>';
                        echo '</select>';
                        }
 
                ?>
        </div>

        <div class="form-group">
            <label for="companion">Do you prefer watching movies alone or with people?<br></label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $alone = '<option value="Alone">Alone</option>';
                        $withPeople = '<option value="With People">With People</option>';
                        $select ='<option value="Select">Select an Option</option>';
                        if($preference->companion=="Alone"){
                            $alone = '<option value="Alone" selected>Alone</option>';
                        }
                        if($preference->companion=="With People"){
                            $withPeople = '<option value="With People" selected>With People</option>';
                        }
                        if($preference->companion=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
 
                        echo '<select class="form-control" id="companion" name="companion">';
                        echo $select;
                        echo $alone;
                        echo $withPeople;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="companion" name="companion">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Alone">Alone</option>';
                        echo '<option value="With People">With People</option>';
                        echo '</select>';
                        }
 
                ?>
        </div>

        <div class="form-group">
            <label for="length">What is the ideal movie length in your opinion?<br></label>
            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $thirty = '<option value="Short">Up to 30 Minutes</option>';
                        $ninty ='<option value="Average">Up to 90 Minutes</option>';
                        $oneTwenthy = '<option value="Long">More Than 120 Minutes</option>';
                        $select ='<option value="Select">Select</option>';
                        if($preference->length=="Short"){
                            $thirty = '<option value="Short" selected>Up to 30 Minutes</option>';
                        }
                        if($preference->length=="Average"){
                            $ninty ='<option value="Average" selected>Up to 90 Minutes</option>';
                        }
                        if($preference->length=="Long"){
                            $oneTwenthy = '<option value="Long" selected>More Than 120 Minutes</option>';
                        }
                        if($preference->length=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="length" name="length">';
                        echo $thirty;
                        echo $ninty;
                        echo $oneTwenthy;
                        echo $select;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="length" name="length">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="Short">Up to 30 Minutes</option>';
                        echo '<option value="Average">Up to 90 Minutes</option>';
                        echo '<option value="Long">More Than 120 Minutes</option>';
                        echo '</select>';
                        }
 
                ?>
        </div>

        <div class="form-group">
            <label for="format">In what format do you prefer to watch movies?<br></label>

            <!-- Using HTTP to understand if need to load answers from the DB -->
            <?php
                    if($find=="found"){
                        $D3 = '<option value="3D">3D</option>';
                        $imax ='<option value="IMAX">IMAX</option>';
                        $other = '<option value="Other">Other</option>';
                        $select ='<option value="Select">Select</option>';
                        if($preference->format=="3D"){
                            $D3 = '<option value="3D" selected>3D</option>';
                        }
                        if($preference->format=="IMAX"){
                            $imax ='<option value="IMAX" selected>IMAX</option>';
                        }
                        if($preference->format=="Other"){
                            $other = '<option value="Other" selected>Other</option>';
                        }
                        if($preference->format=="Select"){
                            $select ='<option value="Select" selected>Select an Option</option>';
                        }
                        echo '<select class="form-control" id="format" name="format">';
                        echo $D3;
                        echo $imax;
                        echo $other;
                        echo $select;
                        echo '</select>';
                    }
                    else{
                        echo '<select class="form-control" id="format" name="format">';
                        echo '<option value="Select" selected>Select an Option</option>';
                        echo '<option value="3D">3D</option>';
                        echo '<option value="IMAX">IMAX</option>';
                        echo '<option value="Other">Other</option>';
                        echo '</select>';
                        }
 
                ?>
        </div>

        <input type="button" id="submit" onclick='saveForm()' class="btn btn-primary" value="Save Form" name="submit">
        <input type="button" id="submit" onclick='sendForm()' class="btn btn-primary" value="Submit Form" name="submit">
        </form>
    </div>
    <script>
        //AJAX Usage
        function sendForm(){
            var request = new XMLHttpRequest();
            request.onreadystatechange=function(){
                if(request.readyState==4&request.status==200){
                    //If credentials were correct, prinitng a message and redirecting to the home page
                    if(request.responseText.trim()=="success"){
                        alert("Your survey answer were submitted successfully!\nRedirecting you to the statistics page!");
                        window.location.href = "stats.php";
                    }
                    else{
                        alert(request.responseText.trim())
                    }
                }
            }
            request.open("POST",'form.php',true);
            request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            request.send("location="+document.getElementById("location").value+"&frequency="+document.getElementById("frequency").value+"&genre="+document.getElementById("genre").value+
            "&languageRadio="+document.querySelector('input[name="languageRadio"]:checked').value+"&platform="+document.getElementById("platform").value+
            "&influence="+document.getElementById("influence").value+"&companion="+document.getElementById("companion").value+"&length="+document.getElementById("length").value
            +"&format="+document.getElementById("format").value+"&submit=submit&status=done");
        }

        function saveForm(){
            var request = new XMLHttpRequest();
            request.onreadystatechange=function(){
                if(request.readyState==4&request.status==200){
                    //If credentials were correct, prinitng a message and redirecting to the home page
                    if(request.responseText.trim()=="success"){
                        alert("Your survey answer were saved successfully!\nRedirecting you to the home page!");
                        window.location.href = "index1.php";
                    }
                    else{
                        alert(request.responseText.trim())
                    }
                }
            }
            request.open("POST",'form.php',true);
            request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            request.send("location="+document.getElementById("location").value+"&frequency="+document.getElementById("frequency").value+"&genre="+document.getElementById("genre").value+
            "&languageRadio="+document.querySelector('input[name="languageRadio"]:checked').value+"&platform="+document.getElementById("platform").value+
            "&influence="+document.getElementById("influence").value+"&companion="+document.getElementById("companion").value+"&length="+document.getElementById("length").value
            +"&format="+document.getElementById("format").value+"&submit=submit&status=save");
        }
    </script>
</body>
</html>