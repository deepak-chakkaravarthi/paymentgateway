<h1>Success</h1>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "user-registration";

// CREATE CONNECTION
$conn = new mysqli($servername,
	$username, $password, $databasename);

// GET CONNECTION ERRORS
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
$query = "SELECT * FROM `payment`;";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);

	if ($result->num_rows > 0)
	{
		// OUTPUT DATA OF EACH ROW
		while($row = $result->fetch_assoc())
		{
			echo "textid: " .
				$row["textid"]. " - Name: " .
				$row["name"]. " | Email: " .
				$row["email"]. " | Phone: " .
				$row["phone"]." | amount: " .
                $row["amount"]. " | status: " .
                $row["status"]." | PaymentID: " .
                $row["paymentid"]."<br>";
		}
	}
	else {
		echo "0 results";
	}

$conn->close();





?>