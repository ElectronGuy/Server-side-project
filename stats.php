<?php
    require_once('includes/init.php');
    require_once('preferencesClass.php');
    // If there is some message to alert so alert it
    if(isset($_SESSION["Message"])){
        echo '<script type="text/javascript">alert("'.$_SESSION["Message"].'");</script>';
        unset($_SESSION["Message"]);
    }

    global $pref;
    $pref = Preference::getPreferencesForUser($_SESSION['userName']);
?>
 
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Survey Stats</title>
<style>
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
            border-bottom:2px solid #d3d3d3;
      }
      .section-3 {
            background-color: #f5f5f5; /* light gray */
            padding: 50px 0;
            text-align:center;
            border-bottom:2px solid #d3d3d3;
            padding-top:10px;
      }
 
      .section-4 {
            background-color: #e9ecef; /* light gray */
            padding: 50px 0;
            text-align:center;
            border-bottom:2px solid #d3d3d3;
            padding-top:10px;
      }
      .section-5 {
            background-color: #f5f5f5; /* light gray */
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
    #LocationsChart{
        padding-top:60px;
    }
    #FrequencyChart{
        padding-top:60px;
    }
    .Charts{
        padding-top:65px;
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
                <h1 class="display-4">Welcome to the Stats Page!</h1>
                <p class="lead">Here you can find interesting facts and statistics about our survey!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-2">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1 class="text-center"></h1>
            <div class="jumbotron text-center">
                <h1 class="display-4">Where do people like to watch movies the most?</h1>
                <p class="lead">Let's find out with our lovely pie chart!<br>Your answer is: <?php echo $pref->location;?></p>
            </div>
          </div>
          <!-- Providing Stats About The Location Preferences -->
          <div class="col-md-6">
            <h1 class="text-center"></h1>
            <canvas id="LocationsChart" style="width:100%;max-width:600px"></canvas>
            <?php
                global $homeCount;
                global $TheatreCount;
                global $DriveInCount;
                $HomeCount = Preference::countValuesInAttribute("location","Home");
                $TheatreCount = Preference::countValuesInAttribute("location","Theatre");
                $DriveInCount = Preference::countValuesInAttribute("location","Drive-In");
            ?>
 
            <script>
                var xValues = ["Home", "Theatre", "Drive-In"];
                var yValues = [<?php echo $HomeCount?>, <?php echo $TheatreCount?>, <?php echo $DriveInCount?>];
                var barColors = [
                "#b91d47",
                "#00aba9",
                "#2b5797",
                "#e8c3b9",
                "#1e7145"
                ];
 
                new Chart("LocationsChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Different Locations Preferences When Watching Movies",
                    responsive: true,
                    maintainAspectRatio: false
                    }
                }
                });
            </script>
            </div>
          </div>
        </div>
      </div>
 
      <div class="section-1">
        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <h1 class="text-center"></h1>
                <div class="jumbotron text-center" style="background-color:#f5f5f5">
                    <h1 class="display-4">How frequent people tend to watch movies?</h1>
                    <p class="lead">Let's find out with our lovely bar chart!<br>Your answer is:
                    <?php if($pref->frequency=="Weekly"){$message="Once a Week";}if($pref->frequency=="Monthly"){$message="Once a Month";}if($pref->frequency=="Yearly"){$message="Once a Year";} echo $message;?>
                    </p>
                </div>
            </div>
            <!-- Providing Stats About The Location Preferences -->
            <div class="col-md-6">
                <h1 class="text-center"></h1>
                <canvas id="FrequencyChart" style="width:100%;max-width:600px"></canvas>
                <?php
                    global $WeeklyCount;
                    global $MonthlyCount;
                    global $YearlyCount;
                    $WeeklyCount = Preference::countValuesInAttribute("frequency","Weekly");
                    $MonthlyCount = Preference::countValuesInAttribute("frequency","Monthly");
                    $YearlyCount = Preference::countValuesInAttribute("frequency","Yearly");
                ?>
                <script>
                var xValues = ["Once a Week", "Once a Month", "Once a Year"];
                var yValues = [<?php echo $WeeklyCount?>, <?php echo $MonthlyCount?>, <?php echo $YearlyCount?>];
                var barColors = ["red", "green","blue","orange","brown"];
 
                new Chart("FrequencyChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                    display: true,
                    text: "Movie Watching Frequnency",
                    responsive: true,
                    maintainAspectRatio: false
                    },
                    scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                }
                });
                </script>
                </div>
            </div>
            </div>
        </div>
 
        <div class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#e9ecef">
                            <h1 class="display-4">What are the most popular movie genres?</h1>
                            <p class="lead">Let's find out with our unique pie chart!<br>Your answer is: <?php echo $pref->genre;?></p></p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="GenreChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $HorrorCount;
                            global $ComedyCount;
                            global $DramaCount;
                            global $fantasyCount;
                            global $scifiCount;
                            global $docoCount;
                            global $thrillerCount;
                            global $actionCount;
                            $HorrorCount = Preference::countValuesInAttribute("genre","Horror");
                            $ComedyCount = Preference::countValuesInAttribute("genre","Comedy");
                            $DramaCount = Preference::countValuesInAttribute("genre","Drama");
                            $fantasyCount = Preference::countValuesInAttribute("genre","Fantasy");
                            $scifiCount = Preference::countValuesInAttribute("genre","SciFi");
                            $docoCount = Preference::countValuesInAttribute("genre","Doco");
                            $thrillerCount = Preference::countValuesInAttribute("genre","Thriller");
                            $actionCount = Preference::countValuesInAttribute("genre","action");
                        ?>
                        <script>
                        var xValues = ["Action","Horror", "Comedy", "Drama", "Fantasy", "SciFi", "Doco", "Thriller"];
                        var yValues = [<?php echo $actionCount?>,<?php echo $HorrorCount?>, <?php echo $ComedyCount?>, <?php echo $DramaCount?>, <?php echo $fantasyCount?>,<?php echo $scifiCount?>,<?php echo $docoCount?>,<?php echo $thrillerCount?>];
                        var barColors = ["red", "green","blue","orange","brown","pink","black","yellow"];
 
                        new Chart("GenreChart", {
                        type: "polarArea",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                            display: true,
                            text: "Movie Genre Preferences",
                            responsive: true,
                            maintainAspectRatio: false
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
 
        <div class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#f5f5f5">
                            <h1 class="display-4">In what language people prefer watching their movies?</h1>
                            <p class="lead">The movie's original language? Maybe their own language (foreign language)? Let's find out!
                            <br>Your answer is: <?php if($pref->language=="yes"){$message="Original Language";} else{$message=="Foreign Language";}echo $message;?>
                            </p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="LanguageChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $yesCount;
                            global $noCount;
                            $yesCount = Preference::countValuesInAttribute("language","yes");
                            $noCount = Preference::countValuesInAttribute("language","no");
                        ?>
                        <script>
                        var xValues = ["Original Language","Foreign Language"];
                        var yValues = [<?php echo $yesCount?>,<?php echo $noCount?>];
                        var barColors = ['rgba(255, 99, 132, 0.2)','rgba(255, 159, 64, 0.2)'];
 
                        new Chart("LanguageChart", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues,
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                            display: true,
                            text: "Original Language Preferences",
                            responsive: true,
                            maintainAspectRatio: false,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
        <div class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#e9ecef">
                            <h1 class="display-4">What is the most popular Movie Platform our users prefer?</h1>
                            <p class="lead">Netflix? Classic Cables? Cinema? Let's find out!<br>Your answer is: <?php echo $pref->platform;?></p></p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="PlatformChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $NetflixCount;
                            global $CablesCount;
                            global $CinemaCount;
                            global $InternetCount;
                            global $OtherCount;
                            $NetflixCount = Preference::countValuesInAttribute("platform","Netflix");
                            $CablesCount = Preference::countValuesInAttribute("platform","Cables");
                            $CinemaCount = Preference::countValuesInAttribute("platform","Cinema");
                            $InternetCount = Preference::countValuesInAttribute("platform","Internet");
                            $OtherCount = Preference::countValuesInAttribute("platform","Other");
                        ?>
                        <script>
                        var xValues = ["Netflix","Cables","Cinema","Internet","Other"];
                        var yValues = [<?php echo $NetflixCount?>,<?php echo $CablesCount?>, <?php echo $CinemaCount?>, <?php echo $InternetCount?>, <?php echo $OtherCount?>];
                        var barColors = ["red","cyan","black","green","blue"];
 
                        new Chart("PlatformChart", {
                        type: "doughnut",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                            display: true,
                            text: "Popular Platform",
                            responsive: true,
                            maintainAspectRatio: false
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
 
        <div class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#f5f5f5">
                            <h1 class="display-4">Watching movies alone?Or maybe with people?</h1>
                            <p class="lead">What do people prefer?<br>Your answer is: <?php echo $pref->companion;?></p></p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="CompanionChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $AloneCount;
                            global $WithPeopleCount;
                            $WithPeopleCount = Preference::countValuesInAttribute("companion","With People");
                            $AloneCount = Preference::countValuesInAttribute("companion","Alone");
                        ?>
                        <script>
                        var xValues = ["Alone","WithPeople"];
                        var yValues = [<?php echo $AloneCount?>,<?php echo $WithPeopleCount?>];
                        var barColors = ["green","yellow"];
 
                        new Chart("CompanionChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                            display: true,
                            text: "Companion Preferences",
                            responsive: true,
                            maintainAspectRatio: false
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
 
        <div class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#e9ecef">
                            <h1 class="display-4">What is the ideal movie length?</h1>
                            <p class="lead">An hour and a half? Two hours? Maybe less?<br>You answer is: 
                            <?php if($pref->length=="Short"){$message=="Up to 30 Minutes";}if($pref->length=="Average"){$message = "Up to 90 Minutes";}if($pref->length=="Long"){$message="Up to 120 Minutes";}echo $message;?>
                            </p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="LengthChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $shortCount;
                            global $averageCount;
                            global $longCount;
                            $shortCount = Preference::countValuesInAttribute("length","Short");
                            $averageCount = Preference::countValuesInAttribute("length","Average");
                            $longCount = Preference::countValuesInAttribute("length","Long");
                        ?>
                        <script>
                        var xValues = ["Up To 30 Minutes","Up To 90 Minutes", "Up To 120 Minutes"];
                        var yValues = [<?php echo $shortCount?>+0,<?php echo $averageCount?>,<?php echo $longCount?>];
                        var barColors = ["green","cyan","yellow"];
 
                        new Chart("LengthChart", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            },
                            legend: {display: false},
                            title: {
                            display: true,
                            text: "Movie Length Preferences",
                            responsive: true,
                            maintainAspectRatio: false}
                    }})
                        </script>
                        </div>
                </div>
            </div>
        </div>
 
        <div class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#f5f5f5">
                            <h1 class="display-4">In what format most of our users love watching movies?</h1>
                            <p class="lead">3D? Maybe IMAX?<br>Your answer is: <?php echo $pref->format;?></p></p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="formatChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $imaxCount;
                            global $d3Count;
                            global $longCount;
                            $IMAXCount = Preference::countValuesInAttribute("format","IMAX");
                            $d3Count = Preference::countValuesInAttribute("format","3D");
                            $otherCount = Preference::countValuesInAttribute("format","Other");
                        ?>
                        <script>
                        var xValues = ["3D", "Other","IMAX"];
                        var yValues = [<?php echo $d3Count?>,<?php echo $otherCount?>,<?php echo $IMAXCount?>];
                        var barColors = ['rgba(255, 99, 132, 0.2)','rgba(255, 159, 64, 0.2)','rgba(45, 30, 64, 0.2)'];
 
                        new Chart("formatChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                            display: true,
                            text: "Format Preferences",
                            responsive: true,
                            maintainAspectRatio: false
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
 
        <div class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <div class="jumbotron text-center" style="background-color:#e9ecef">
                            <h1 class="display-4">What affects you to watch movies the most?</h1>
                            <p class="lead">Trailers? Recommendations? Critics Reviews?<br>Your answer is: <?php echo $pref->influence;?></p></p>
                        </div>
                    </div>
                    <!-- Providing Stats About The Location Preferences -->
                    <div class="col-md-6">
                        <h1 class="text-center"></h1>
                        <canvas id="influenceChart" class="Charts" style="width:100%;max-width:600px"></canvas>
                        <?php
                            global $trailerCount;
                            global $recommendationCount;
                            global $reviewCount;
                            global $OtherCount;
                            $trailerCount = Preference::countValuesInAttribute("influence","Trailers");
                            $recommendationCount = Preference::countValuesInAttribute("influence","Recommendations");
                            $reviewCount = Preference::countValuesInAttribute("influence","Reviews");
                            $OtherCount = Preference::countValuesInAttribute("influence","Other");
                            
                        ?>
                        <script>
                        var xValues = ["Trailers", "Recommendations","Reviews","Other"];
                        var yValues = [<?php echo $trailerCount?>,<?php echo $recommendationCount?>,<?php echo $reviewCount?>, <?php echo $OtherCount?>];
                        var barColors = ['rgba(255, 99, 132, 0.2)','rgba(255, 159, 64, 0.2)','rgba(45, 30, 64, 0.2)','rgba(95, 38, 4, 0.2)'];
 
                        new Chart("influenceChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                            display: true,
                            text: "Format Preferences",
                            responsive: true,
                            maintainAspectRatio: false
                            }
                        }
                        });
                        </script>
                        </div>
                </div>
            </div>
        </div>
</body>
</html>