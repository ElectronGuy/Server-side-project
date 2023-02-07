<?php
    require_once('includes/init.php');

    //Checking if the user is already signed in, if not, redirecting him to the login page
    if(!$session->signed_in){
        $_SESSION["Message"] = "You have to be logged in to to watch our home page! please log in";
        header('Location:loginFront.php');
        exit;
    }
    //If we received a message from another page, we will display it before moving forward
    if(isset($_SESSION["Message"])){
        echo '<script type="text/javascript">alert("'.$_SESSION["Message"].'");</script>';
        unset($_SESSION["Message"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Home Page</title>
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
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        .section-1 {
            background-color: #f5f5f5; /* light gray */
            padding: 50px 0;
            text-align:center;
            border-bottom:2px solid #d3d3d3;
      }
      .section-2 {
            background-color: #e9ecef; /* light blue */
            padding: 50px 0;
            text-align: center;
      }
      /* Add custom CSS here */
      body {
        background-image: url('https://images.pexels.com/photos/1084966/pexels-photo-1084966.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        background-size: cover;
      }
      *{
        box-sizing: border-box;
      }
      img {
        border: 2px solid #d3d3d3;
        border-radius: 10px;
        }
      .jumbotron{
        padding-bottom:0;
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
    <div class="section-1">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"></h1>
            <div class="jumbotron text-center" style="background-color:#f5f5f5; background-size: cover;">
                <h1 class="display-4">Welcome to the best Movies website in the internet!</h1>
                <p class="lead">Here you can find info about movies, actors, etc'.<br>You can also fill our movies survey and see how your answers stand next to others!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-2">
      <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <img src="photos/deniro.png">
            </div>
          <div class="col-lg-6">
          <div class="jumbotron text-center" style="background-color:#e9ecef; background-size: cover;">
                <h1 class="display-4">If you are a movie lover, you are in the right place!</h1>
                <p class="lead">Explore our never ending info about Movies, Actors, Cinema and more!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>