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

// Function to update parcel information in the database
function updateParcelInfo($trackNo, $colDate, $parStatus)
{
    $conn = connectToDatabase();

    // Prepare the SQL statement to update colDate and parStatus for the specific parcel
    $stmt = $conn->prepare("UPDATE parcel SET colDate = ?, parStatus = ? WHERE trackNo = ?");
    $stmt->bind_param("sss", $colDate, $parStatus, $trackNo);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
        // header("Location: Aparcelinfo.php");
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to update parcel information."));
        
    }

    $stmt->close();
    $conn->close();
}

// Check if the request is a POST request and if the required data is present
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["trackNo"], $_POST["colDate"], $_POST["parStatus"])) {
    $trackNo = $_POST["trackNo"];
    $colDate = $_POST["colDate"];
    $parStatus = $_POST["parStatus"];

    updateParcelInfo($trackNo, $colDate, $parStatus);
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request."));
}
?>
