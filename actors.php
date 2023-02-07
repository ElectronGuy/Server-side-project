<?php
    require_once('includes/init.php');
    require_once('actorClass.php');
    require_once('movieClass.php');

    //Checking if the user is already signed in, if not, redirecting him to the login page
    if(!$session->signed_in){
        $_SESSION["Message"] = "You have to be logged in to to watch our home page! please log in";
        header('Location:loginFront.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Our Actors&Movies Page</title>
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
            padding-bottom:0;
      }
      .section-2 {
            background-color: #e9ecef; /* light blue */
            padding: 50px 0;
            text-align: center;
      }
      .section-3 {
            background-color: #e9ecef; /* light gray */
            padding: 50px 0;
            text-align:center;
            border-bottom:2px solid #d3d3d3;
            padding-top:10px;
      }

      #section-4 {
            background-color: #e9ecef; /* light gray */
            padding: 50px 0;
            text-align:center;
            border-bottom:2px solid #d3d3d3;
            padding-top:10px;
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
    .container-actors{
        display:flex;
        flex-wrap: wrap;
    }
    .actor{
        flex:1 0 45%;
        margin:10px;
        background-color:#f5f5f5;
    }
    .jumbotron{
        margin-bottom:0;
    }
    .movie-form {
  background-color: #f5f5f5;
  padding: 20px;
  margin: 0 auto;
  width: 80%;
  border-radius: 10px;
  box-shadow: 2px 2px 5px #aaa;
}

.movie-form .movie-logo {
  text-align: center;
  margin-bottom: 20px;
}
.movie-form .movie-logo img{
  max-width:100%;
}
.form-group {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.form-group label {
  width: 120px;
  font-weight: bold;
  margin-right: 10px;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group input[type="url"],
.form-group textarea {
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  width: 100%;
}
.form-group input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.form-group input[type="submit"]:hover {
  background-color: #45a049;
}
.nav-item-user-name {
  color: orange;
  
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
                <h1 class="display-4">Welcome to the Actors&Movies Page!</h1>
                <p class="lead">Here you can find information about all of the actors & movies in our DB!<br><a href="#section-4">Go To Movie Section</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-3">
        <h1>Our Actors Information List:</h1>
        <div class="container-actors">
            <?php
                $actors = Actor::fetch_actors();
                foreach($actors as $actor){
                    echo "<div class='card actor'>";
                    echo "<div class='card-body'>";
                    echo "<p><b>First Name</b>: " . $actor->firstName. "</p>";
                    echo "<p><b>Last Name:</b> " . $actor->lastName. "</p>";
                    echo "<p><b>Age</b>: " . $actor->age. "</p>";
                    echo "<p><b>Nationality:</b> " . $actor->nationality. "</p>";
                    echo "<p><b>Background:</b> " . $actor->background. "</p>";
                    echo "<p> <image src='$actor->image' widht=200px height=200px><p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    <div id="section-4">
        <h1>Our Movies Information List:</h1>
        <div class="container-actors">
            <?php
                $movies = Movie::fetch_movies();
                if(!isset($movies)){
                  echo '<p>There is no movie in the DB</p>';
                }
                else{
                  foreach($movies as $movie){
                      echo "<div class='card actor'>";
                      echo "<div class='card-body'>";
                      echo "<p><b>Name:</b> " . $movie->name. "</p>";
                      echo "<p><b>Producer:</b> " . $movie->producer. "</p>";
                      echo "<p><b>Distribution Year:</b> " . $movie->distYear. "</p>";
                      echo "<p><b>Genre:</b> " . $movie->genre. "</p>";
                      echo "<p><b>Description:</b> " . $movie->description. "</p>";
                      echo "<p> <image src='$movie->image' width=200px height=200px><p>";
                      echo "</div>";
                      echo "</div>";
                  }
                }
            ?>
        </div>
    </div>

</body>
</html>