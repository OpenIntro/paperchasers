<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="paper";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sql = "SELECT * FROM addcustomer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["customerid"]. " - Firm Name: " . $row["fname"]. " <br>";
		echo "id: " . $row["customerid"]. " - Contact Name: " . $row["cname"]. " <br>";
		echo "id: " . $row["customerid"]. " - City: " . $row["city"]. " <br>";
		echo "id: " . $row["customerid"]. " - State: " . $row["state"]. " <br>";
		
    }
} else {
    echo "0 results";
}

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?> 

