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

/// Function to validate admin login
function validateAdminLogin($ID, $adPassword)
{
    $conn = connectToDatabase();

    // Sanitize input to prevent SQL injection
    $ID = $conn->real_escape_string($ID);
    $adPassword = $conn->real_escape_string($adPassword);

    // Query to check if the admin exists in the database
    $sql = "SELECT * FROM admin WHERE ID = '$ID'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $adminData = $result->fetch_assoc();
        $storedPassword = $adminData['adPassword'];

        // Verify the password
        if ($adPassword === $storedPassword) {
            return true; // Login successful
        }
    }

    return false; // Invalid login credentials
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID = $_POST["ID"];
    $adPassword = $_POST["adPassword"];

    if (validateAdminLogin($ID, $adPassword)) {
        header("Location: users.php");
        exit();
    } else {
        $error_message = "Invalid login credentials!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Login</title>
    <link rel="icon" href="img/fav.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- main css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- clear form -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("ID").value = "";
    document.getElementById("adPassword").value = "";
    });
    </script>


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

                <li><a href="index.html">Home</a> </li>
				<li><a href="adminlogin.html">Login</a><i class="ion-ios-circle-filled color"></i></li>
				<li><a href="adminregister.html">Register Admin</a></li>
            </ul>
        </nav>
	</div>
        <!-- end nav -->
    <!-- Admin Login Section -->
    <section class="box-login">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-box">
                        <h2>Admin Login</h2>
                        <form action="adminlogin.php" method="POST">
                            <?php if (isset($error_message)) : ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="ID">Admin ID</label>
                                <input type="text" class="form-control" id="ID" name="ID" required>
                            </div>
                            <div class="form-group">
                                <label for="adPassword">Password</label>
                                <input type="password" class="form-control" id="adPassword" name="adPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="adminregister.php" style="margin-left: 350px;">Register Admin -></a>
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
