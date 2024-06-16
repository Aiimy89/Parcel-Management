

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Users</title>
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

        .user-info {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            margin-top: 15px;
            margin-left: 350px;
            margin-right: 350px;
        }

        .user-info h3 {
            margin: 0;
        }

        .user-info p {
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

                <li><a href="index.html">Home</a> </li>
				<li><a href="users.html">Users</a><i class="ion-ios-circle-filled color"></i></li>
				<li><a href="userRegistration.php">Register User</a></li>
            </ul>
        </nav>
	</div>
    <!-- end nav -->
	
    <!-- Top bar -->
    <div class="top-bar">
        <h1>Users</h1>
    </div>
    <!-- end Top bar -->
    
    <!-- Search Query -->
    <div style="text-align: center; margin-top:20px;">
    <form method="post">
        <label>Search</label>
        <input type="text" name="search">
        <input type="submit" name="submit">
    </form>
    </div>


    <?php
        $link = mysqli_connect("localhost", "root", "", "parcel");

        if ($link === false) {
            die("ERROR: Could not connect." . mysqli_connect_error());
        }

        if (isset($_POST["submit"])) {
            $str = "%" . $_POST["search"] . "%"; // Concatenate % to the search term
            $sql = "SELECT * FROM user WHERE uName LIKE ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $str); // Bind the concatenated search term
            mysqli_stmt_execute($stmt);
            $searchResult = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($searchResult) > 0) {
                // Display search results
                while ($row = mysqli_fetch_assoc($searchResult)) {
                    ?>
                    <div class="user-info">
                        <h3>Name: <?php echo $row["uName"]; ?></h3>
                        <p>matricNo: <?php echo $row["matricNo"]; ?></p>
                        <a href="userprofile.php?matricNo=<?php echo $row['matricNo']; ?>">Detail</a>
                    </div>
                    <?php
                }
            } else {
                // Display message when no search results are found
                ?>
                <div class="user-info">
                    <p>No search results found.</p>
                </div>
                <?php
            }
        } else {
            // Display the original list when no search query is made
            $result = mysqli_query($link, "SELECT uName, matricNo FROM user");
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="user-info">
                    <h3>Name: <?php echo $row["uName"]; ?></h3>
                    <p>matricNo: <?php echo $row["matricNo"]; ?></p>
                    <a href="userprofile.php?matricNo=<?php echo $row['matricNo']; ?>">Detail</a>
                </div>
                <?php
            }
        }

        mysqli_close($link);
        ?>


    
    <!-- Main container -->
    <div class="container main-container clearfix"> 
        <a href="userRegistration.php" class="button-link">+</a>
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