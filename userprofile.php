

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Profile</title>
    <link rel="icon" href="img/fav.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- main css -->
    <link href="css/style.css" rel="stylesheet">


    <!-- modernizr -->
    <script src="js/modernizr.js"></script>

	<style>
        /* Style the anchor element to look like a button */
        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #05F845;
            color: #fff;
            text-decoration: none;
            border-radius: 50%;
        }

        .button-link:hover {
            background-color: #DEFA60;
        }
		
		body{
			texcentergn: right;
		}

        .parcel-info {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            margin-top: 15px;
            margin-left: 350px;
            margin-right: 350px;
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
				<li><a href="users.html">Users</a></li>
				<li><a href="AparcelRegister.php">Register Parcel</a></li>
            </ul>
        </nav>
	</div>
    <!-- end nav -->
    
    <!-- Top bar -->
    <div class="top-bar">
        <h1>User Profile</h1>
    </div>
    <!-- end Top bar -->

    <!-- Php -->
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

function displaySpecificUserInfo()
{
    if (isset($_GET['matricNo'])) {
        $matricNo = $_GET['matricNo'];

        $conn = connectToDatabase();

        // Fetch user's name from the database based on matricNo
        $userSql = "SELECT uName FROM user WHERE matricNo = '$matricNo'";
        $userResult = $conn->query($userSql);

        if ($userResult->num_rows === 1) {
            $userRow = $userResult->fetch_assoc();

            // Display the user's name
            echo '<h2 style="text-align:center">' . $userRow["uName"] . '</h2>';

            // Fetch specific user details from the database based on matricNo
            $sql = "SELECT parName, trackNo, parStatus FROM parcel WHERE matricNo = '$matricNo'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="parcel-info">';
                    echo '<h3>Parcel Name: ' . $row["parName"] . '</h3>';
                    echo '<p>Tracking Number: ' . $row["trackNo"] . '</p>';
                    echo '<p>Status: ' . $row["parStatus"] . '</p>';
                    echo '<a href="Aparcelinfo.php?trackNo=' . $row['trackNo'] . '">Detail</a>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align:center">No parcels registered.</p>';
            }
        } else {
            echo '<p>User not found with the provided matriculation number.</p>';
        }

        $conn->close();
    } else {
        echo '<p></p>';
    }
}

// Call the function to display user and parcel information
displaySpecificUserInfo();
?>




    <!-- Main container -->
    <div class="container main-container clearfix"> 
        <a href="AparcelRegister.php" class="button-link">+</a>
    </div>
    <!-- end Main container -->


    <!-- footer -->
    <footer>
        <div class="container-fluid">
            <p class="copyright">© Iqbal 21B08I009</p>
        </div>
    </footer>
    <!-- end footer -->
    
    <!-- back to top -->
    <a href="#0" class="cd-top"><i class="ion-android-arrow-up"></i></a>
    <!-- end back to top -->



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