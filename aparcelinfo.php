<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parcel Information</title>
    <link rel="icon" href="img/fav.png" type="image/x-icon">
	
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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .parcel-info {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .parcel-info h3 {
            margin: 0;
        }

        .parcel-info p {
            margin: 5px 0;
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
				<li><a href="users.php">Users</a></li>
				<li><a href="Aparcelinfo.php">Parcel Information</a> <i class="ion-ios-circle-filled color"></i></li>
            </ul>
        </nav>
	</div>
        <!-- end nav -->

    <h2>Parcel Information</h2>
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

        // Function to retrieve and display specific parcel information based on trackNo
        function displaySpecificParcelInfo()
        {
            if (isset($_GET['trackNo'])) {
                $trackNo = $_GET['trackNo'];
    
                $conn = connectToDatabase();
    
                // Fetch specific parcel details from the database based on trackNo
                $sql = "SELECT parName, trackNo, parStatus, phone, courier, delDate, colDate FROM parcel WHERE trackNo = '$trackNo'";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
    
                    echo '<div class="parcel-info">';
                    echo '<h3>Parcel Name: ' . $row["parName"] . '</h3>';
                    echo '<p>Tracking Number: ' . $row["trackNo"] . '</p>';

                    // Form for updating parcel information
                    echo '<form action="update_parcel.php" method="post">';
                    echo '<input type="hidden" name="trackNo" value="' . $row["trackNo"] . '">';

                    // Display the drop-down menu for "Status"
                    echo '<label for="parstatus" style="margin-right: 7px";>Status:</label>';
                    echo '<select name="parStatus" id="parstatus">';
                    echo '<option value="On Delivery" ' . ($row["parStatus"] === "On Delivery" ? "selected" : "") . '>On Delivery</option>';
                    echo '<option value="Delivered" ' . ($row["parStatus"] === "Delivered" ? "selected" : "") . '>Delivered</option>';
                    echo '<option value="Collected" ' . ($row["parStatus"] === "Collected" ? "selected" : "") . '>Collected</option>';
                    echo '</select>';

                    // Display the input field for "Date Collected"
                    echo '<label for="colDate" style="margin-right:7px; margin-left:7px;";>Date Collected:</label>';
                    echo '<input type="date" name="colDate" id="colDate" value="' . $row["colDate"] . '">';

                    // Add the "Update" and "Delete" buttons for the parcel
                    echo '<input style="margin-left: 7px; margin-right: 20px; background-color: blue; color: white; border: 1px solid #87CEFA;" type="submit" name="update" value="Update">';
                    echo '<input style="background-color: red; color: white; border: 1px solid red;" type="submit" name="delete" value="Delete">';

                    echo '</form>';

                    // Display the rest of the parcel information
                    echo '<p>Courier: ' . $row["courier"] . '</p>';
                    echo '<p>Phone Number: ' . $row["phone"] . '</p>';
                    echo '<p>Date Added: ' . $row["delDate"] . '</p>';
                    echo '<p>Date Collected: ' . $row["colDate"] . '</p>';
                    echo '</div>';
                } else {
                    echo '<p>No parcel found with the provided tracking number.</p>';
                }
    
                $conn->close();
            } else {
                echo '<p>No tracking number provided.</p>';
            }
        }

    // Call the function to display parcel information
    displaySpecificParcelInfo();
    ?>

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
