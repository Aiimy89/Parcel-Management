<?php

    $link=mysqli_connect("localhost","root","","parcel");

    if($link === false){
        die("ERROR: Could not connect." .mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Get the submitted form data
        $uName = mysqli_real_escape_string($link, $_POST["uName"]);
        $matricNo = mysqli_real_escape_string($link, $_POST["matricNo"]);
        $phone = mysqli_real_escape_string($link, $_POST["phone"]);
        $Password = mysqli_real_escape_string($link, $_POST["Password"]);

        $sql="INSERT INTO user (uName, matricNo , phone, Password) VALUES ('$uName','$matricNo','$phone','$Password')";

        if(mysqli_query($link,$sql)){
            header("Location:users.html");
            echo "Record added successfully.<br>";
        }
        
        else{
            echo "ERROR: Could not able to execute $sql." .mysqli_error($link);
        }

        mysqli_close($link); //close connection
    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registration</title>
    <link rel="icon" href="img/fav.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- main css -->
    <link href="css/style.css" rel="stylesheet">


    <!-- modernizr -->
    <script src="js/modernizr.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<!-- Preloader -->
    <div id="preloader">
        <div class="pre-container">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
	<div class="container-fluid">
        <!-- box header -->
        <header class="box-header">
            <div class="box-logo">
                <a href="index.html"><img src="img/box_icon.png" width="40"  alt="Logo"></a>
            </div>
            <!-- box-nav -->
            <a class="box-primary-nav-trigger" href="#0">
                <span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
            </a>
            <!-- box-primary-nav-trigger -->
        </header>
        <!-- end box header -->

        <!-- nav -->
        <nav>
            <ul class="box-primary-nav">
                <li class="box-label">Menu</li>

                <li><a href="index.html">Home</a></li>
				<li><a href="login.html">Login</a></li>
				<li><a href="userRegistration.html">Register</a><i class="ion-ios-circle-filled color"></i></li>
            </ul>
        </nav>
	</div>
        <!-- end nav -->
    <!-- Registration Section -->
    <section class="box-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <h2>Registration</h2>
                        <form action="userRegistration.php" method="POST">
                        <div class="form-group">
                                <label for="uName">Name</label>
                                <input type="text" class="form-control" id="uName" name="uName" required>
                            </div>
                            <div class="form-group">
                                <label for="ID">Matric No.</label>
                                <input type="text" class="form-control" id="matricNo" name="matricNo" required>
                            </div>
                            <div class="form-group">
                                <label for="adPhone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery-2.1.1.js"></script>
    <!--  plugins -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/animated-headline.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <!--  custom script -->
    <script src="js/custom.js"></script>
</body>

</html>
