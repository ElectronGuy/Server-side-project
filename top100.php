<?php

require_once('includes/init.php');
//Checking if the user is already signed in, if not, redirecting him to the login page
if(!$session->signed_in){
    $_SESSION["Message"] = "You have to be logged in to to watch our home page! please log in";
    header('Location:loginFront.php');
    exit;
}
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb-top-100-movies.p.rapidapi.com/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: imdb-top-100-movies.p.rapidapi.com",
		"X-RapidAPI-Key: 352e196459msh5c4751f37ce56d5p17bbebjsn04f76551390b"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
}

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>IMDB Top 100</title>
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
        .container-actor {
            display: flex;
            flex-wrap: wrap;
        }

        .actor {
        flex: 1 0 30%; /* this will make each div take up 1/3 of the container's width */
        margin: 10px;
        background-color: #f5f5f5; /* this sets the background color of the div */
        transition: all 0.3s ease; /* this sets a smooth transition effect for hover */
        }

        .actor:hover {
        transform: scale(1.1); /* this increases the size of the div by 10% on hover */
        box-shadow: 2px 2px 5px #aaa; /* this adds a subtle shadow on hover */
        background-color: #e0e0e0; /* this changes the background color on hover */
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
    .mainH1{
        margin-bottom:50px;
        margin-top:50px;
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
                <h1 class="display-4">Welcome to the IMDB Top 100 Page!</h1>
                <p class="lead">Here you can find the top 100 movies according to the known site, "IMDB"<br>Please note that the list will update according to the IMDB ranking live!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-3">
        <h1 class="mainH1">IMDB Top 100 Movies List</h1>
        <div class="container-actors">
            <?php
                $moviesArray = json_decode($response,true);
                echo $response;
                foreach($moviesArray as $movie){
                    echo "<div class='card actor'>";
                    echo "<div class='card-body'>";
                    echo "<p><b>Movie IMDB Rank</b>: " . $movie['rank']. "</p>";
                    echo "<p><b>Name</b>: " . $movie['title']. "</p>";
                    echo "<p><b>Year</b>: " . $movie['year']. "</p>";
                    $genres="";
                    foreach ($movie['genre'] as $genre){
                        $genres.=$genre.", ";
                    }
                    $genres = substr_replace($genres,".",-2);
                    echo "<p><b>Genre</b>: " . $genres. "</p>";

                    $directors="";
                    foreach ($movie['director'] as $director){
                        $directors.=$director.", ";
                    }
                    $directors = substr_replace($directors,".",-2);
                    echo "<p><b>Directors:</b> " . $directors. "</p>";

                    $writers="";
                    foreach ($movie['writers'] as $writer){
                        $writers.=$writer.", ";
                    }
                    $writers = substr_replace($writers,".",-2);
                    echo "<p><b>Writers:</b> " . $writers. "</p>";

                    echo "<p><b>Description:</b> " . $movie['description']. "</p>";
                    $trailer = $movie['trailer'];
                    echo "<p><b>Trailer YouTube Link:</b> <a href='$trailer'>Trailer</a></p>";
                    $image = $movie['image'];
                    echo "<p> <image src='$image' width=280px height=250px><p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>