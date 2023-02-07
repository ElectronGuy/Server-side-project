<?php
    require_once('includes/init.php');
    //Checking if the user is already signed in - if yes, redirecting him to the home page
    if($session->signed_in){
        $_SESSION["Message"] = "You are already logged in, if you want to register again, please sign out first.";
        header('Location:index1.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Registration</title>
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
            margin: auto; /* Center the form on the page */
            margin-top:20px;
            margin-bottom:20px;
        }
        .someMargin{
            margin-bottom: 8px;
        }
        nav{
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

        #secondH1{
            padding-top:0px;
        }
        .noPadding{
            padding-left:0px;
            margin-top:5px;
            margin-bottom:5px;
        }
    </style>
</head>
 
<body>
    <nav>
    <ul>
        <li><a href= "loginFront.php">Login</a><li>
        <li><a href="index1.php">Home</a></li>
        <li><a href="formFront.php">Survey</a></li>
        <li><a href="actors.php">Actors&Movies</a></li>
        <li><a href="top100.php">IMDB Top 100</a></li>
        <li><a href="registrationFront.php">Registration</a></li>
        <li><a href="logout.php">Sign Out</a></li>
    </ul>
    </nav>
    <div class="form-body">
        <h1>Registration Form<hr></h1><h1 id="secondH1">In order to fill our survey and watch the statistics of it,<br> you will have to register!</h1>
        <hr>
        <form method = "POST"> 
        <div class="form-group">
            <label for="userName">User Name</label>
            <input type="text" class="form-control" id="userName" name="userName" aria-describedby="userNameHelp" placeholder="Enter User Name">
            <small id="textHelper" class="form-text text-muted">User name can contain only numbers and english letters. Please use up to 8 characters.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Enter Your Password">
            <small id="textHelper" class="form-text text-muted">Password need to contain At least one small letter and one capital letter.<br>
            Password length has to be 8-12 characters.</small>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Your Email">
            <small id="textHelper" class="form-text text-muted">Please enter a valid email address.</small>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" name="age" id="age" aria-describedby="ageHelp" placeholder="Enter Your Age">
            <small id="textHelper" class="form-text text-muted">Age has to be 18-120. Minors are not allowed!</small>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">Sex:</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="SexRadio" id="SexMaleOption" value="Male" checked>
            <label class="form-check-label" for="SexMaleOption">
                Male
            </label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="SexRadio" id="SexFemaleOption" value="Female">
            <label class="form-check-label" for="SexFemaleOption">
                Female
            </label>
        </div>
        <div class="form-check noPadding">
            <label class="form-check-label">Name & Last Name</label>
        </div>
        <div class="form-row">
            <div class="col">
                <input type="text" name="firstName" class="form-control" placeholder="First name" id="firstName">
            </div>
            <div class="col someMargin">
                <input type="text" class="form-control" name="lastName" placeholder="Last name" id="lastName">
            </div>
        </div>
        <input type="button" id="submit" onclick='register()' class="btn btn-primary" value="Register" name="submit">
        </form>
    </div>
    <script>
        //AJAX Usage
        function register(){
            var request = new XMLHttpRequest();
            request.onreadystatechange=function(){
                if(request.readyState==4&request.status==200){

                    //If credentials were correct, prinitng a message and redirecting to the home page
                    if(request.responseText.trim()=="found"){
                        alert("Registration has been completed successfully.\nPlease Log in to your new account!");
                        window.location.href = "loginFront.php";
                    }
                    else{
                        alert(request.responseText.trim())
                    }
                }
            }
            request.open("POST",'registration.php',true);
            request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            request.send("userName="+document.getElementById("userName").value+"&password="+document.getElementById("password").value+"&email="+document.getElementById("email").value+
            "&age="+document.getElementById("age").value+"&SexRadio="+document.querySelector('input[name="SexRadio"]:checked').value+"&firstName="+document.getElementById("firstName").value+
            "&lastName="+document.getElementById("lastName").value+"&submit=submit");
        }
    </script>
</body>
</html>