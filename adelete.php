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

// Function to delete a parcel based on trackNo
function deleteParcel()
{
    if (isset($_POST['trackNo'])) {
        $trackNo = $_POST['trackNo'];

        $conn = connectToDatabase();

        // Delete the parcel from the database based on trackNo
        $sql = "DELETE FROM parcel WHERE trackNo = '$trackNo'";
        $result = $conn->query($sql);

        if ($result) {
            echo '<p>Parcel with Tracking Number ' . $trackNo . ' has been deleted successfully.</p>';
            header("Location: userprofile.php");
            exit();
        } else {
            echo '<p>Error deleting parcel: ' . $conn->error . '</p>';
        }

        $conn->close();
    } else {
        echo '<p>No tracking number provided for deletion.</p>';
    }
}

// Call the function to delete the parcel
deleteParcel();
?>
