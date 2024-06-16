<?php

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

// Function to handle parcel registration
function registerParcel($parName, $trackNo, $matricNo, $phone, $courier, $parStatus, $delDate)
{
    $conn = connectToDatabase();

    // Sanitize input to prevent SQL injection
    $parName = $conn->real_escape_string($parName);
    $trackNo = $conn->real_escape_string($trackNo);
    $matricNo = $conn->real_escape_string($matricNo);
    $phone = $conn->real_escape_string($phone);
    $courier = $conn->real_escape_string($courier);
    $parStatus = $conn->real_escape_string($parStatus);
    $delDate = $conn->real_escape_string($delDate);
    // $colDate = $conn->real_escape_string($colDate);

    // Insert parcel data into the database
    $sql = "INSERT INTO parcel (parName, trackNo, matricNo, phone, courier, parStatus, delDate) 
            VALUES ('$parName', '$trackNo', '$matricNo', '$phone', '$courier', '$parStatus', '$delDate')";

    if ($conn->query($sql) === TRUE) {
        return true; // Parcel registration successful
    } else {
        return false; // Parcel registration failed
    }
}

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $parName = $_POST["parName"];
        $trackNo = $_POST["trackNo"];
        $matricNo = $_POST["matricNo"];
        $phone = $_POST["phone"];
        $courier = $_POST["courier"];
        $parStatus = $_POST["parStatus"];
        $delDate = $_POST["delDate"];
        // $colDate = $_POST["colDate"];
    

    if (registerParcel($parName, $trackNo, $matricNo, $phone, $courier, $parStatus, $delDate)) {
        // Parcel registration successful, redirect to a success page or do further processing
        header("Location: users.php");
        exit();
    } else {
        // Parcel registration failed, show an error message or do further processing
        $error_message = "Failed to register the parcel. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Registration</title>
	
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">
	
	<!-- main css -->
    <link href="css/style.css" rel="stylesheet">


    <!-- modernizr -->
    <script src="js/modernizr.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
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
				<li><a href="myparcel.html">My Parcel</a></li>
				<li><a href="parcelRegister.html">Register Parcel</a> <i class="ion-ios-circle-filled color"></i></li>
            </ul>
        </nav>
	</div>
        <!-- end nav -->
    <h2>Parcel Registration</h2>
    <form action="AparcelRegister.php" method="POST">
        <label for="parName">Parcel Name:</label>
        <input type="text" id="parName" name="parName" required>

        <label for="trackNo">Tracking Number:</label>
        <input type="text" id="trackNo" name="trackNo" required>

        <label for="matricNo">Matric No.:</label>
        <input type="text" id="matricNo" name="matricNo" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="courier">Courier:</label>
        <input type="text" id="courier" name="courier" required>

        <label for="parStatus">Status:</label>
        <select id="parStatus" name="parStatus">
        <option value="On Delivery">On Delivery</option>
        </select>

        <label style="margin-top: 20px" for="parDate">Date:</label>
        <input type="date" id="delDate" name="delDate" required>

        <button style="margin-top: 10px" type="submit">Register Parcel</button>
    </form>
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
