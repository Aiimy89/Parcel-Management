<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

// Function to establish a database connection
function connectToDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "parcel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
/// Function to validate user login
function validateUserLogin($matricNo, $Password)
{
    $conn = connectToDatabase();

    // Sanitize input to prevent SQL injection
    $matricNo = $conn->real_escape_string($matricNo);
    $Password = $conn->real_escape_string($Password);

    // Query to check if the admin exists in the database
    $sql = "SELECT * FROM user WHERE matricNo = '$matricNo'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $userData = $result->fetch_assoc();
        $storedPassword = $userData['Password'];

        // Verify the password
        if ($Password === $storedPassword) {
            return true; // Login successful
        }
    }

    return false; // Invalid login credentials
}

?>

<?php
// login.php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricNo = $_POST["matricNo"];

    // Perform user authentication against the database
    // (You need to implement this part based on your database setup)

    // If the user is authenticated, store the matricNo in a session variable
    $_SESSION["matricNo"] = $matricNo;

    // Redirect to the page where you want to display the list of parcels
    header("Location: myparcel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
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
                <a href="index.html"><img src="img/box_icon.png" width="50"  alt="Logo"></a>
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
				<li><a href="login.php">Login</a><i class="ion-ios-circle-filled color"></i></li>
				<li><a href="userRegistration.php">Register</a></li>
            </ul>
        </nav>
	</div>
        <!-- end nav -->
    <!-- Login Section -->
    <section class="box-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <h2>Login</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="matricNo">Matric No.</label>
                                <input type="text" class="form-control" id="matricNo" name="matricNo" required>
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
							<a href="userRegistration.php" style="margin-left: 20px;">Register</a>
                            <a href="adminlogin.php" style="margin-left: 350px;">Admin?</a>
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
