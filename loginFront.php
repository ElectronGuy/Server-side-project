<?php
    require_once('includes/init.php');
    // If already singed in go to home page and terminate any command of this page
    if($session->signed_in){
        $_SESSION["Message"] = "You are already logged in!";
        header('Location: index1.php');
        exit;
    }
    // If there is some message to alert so alert it
    if(isset($_SESSION["Message"])){
        echo '<script type="text/javascript">alert("'.$_SESSION["Message"].'");</script>';
        unset($_SESSION["Message"]);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Login Page</title>
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

        #secondH1{
            padding-top:0px;
        }
        .noPadding{
            padding-left:0px;
            margin-top:5px;
            margin-bottom:5px;
        }
        .mainH1{
            text-align:center;
        }
        .reg{
            margin:auto;
            width:600px;
        }
        .reg :hover{
            background-color: #ccc;
            box-shadow: 0px 0px 20px #999;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
    <ul>
        <li><a href="index1.php">Home</a></li>
        <li><a href="formFront.php">Survey</a></li>
        <li><a href="actors.php">Actors&Movies</a></li>
        <li><a href="top100.php">IMDB Top 100</a></li>
        <li><a href="registrationFront.php">Registration</a></li>
        <li><a href="logout.php">Sign Out</a></li>
    </ul>
    </nav>
    <div class="form-body">
        <h1 class="mainH1">Login Page<hr></h1><h1 class="mainH1">Please log in!</h1>
        <hr>
        <form> 
        <div class="form-group">
            <label for="userName">User Name</label>
            <input type="text" class="form-control" id="userName" name="userName" aria-describedby="userNameHelp" placeholder="Enter User Name">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Enter Your Password">
        </div>
        <input type="button" id="submit" onclick='login()' class="btn btn-primary" value="Login" name="submit">
        </form>
    </div>
    <div class="reg">
        <p>Are you not registered to our website yet?!<br>Please register to see any content of the site!<br>
        <a href="registrationFront.php">Register Now!</a></p>
    </div>
    <script>
        //AJAX Usage
        function login(){
            var request = new XMLHttpRequest();
            request.onreadystatechange=function(){
                if(request.readyState==4&request.status==200){

                    //If credentials were correct, prinitng a message and redirecting to the home page
                    if(request.responseText.trim()=="found"){
                        alert("Your are now logged in! Redirecting you to the home page.");
                        window.location.href = "index1.php";
                    }
                    else{
                        alert(request.responseText.trim())
                    }
                }
            }
            request.open("POST",'login.php',true);
            request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            request.send("userName="+document.getElementById("userName").value+"&password="+document.getElementById("password").value+"&submit=submit");
        }
    </script>
</body>
</html>