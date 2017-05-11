<html>
<head><title>getAllWords</title></head>

<body>

<h1>List of All Registered Words</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=words", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM Words";

	print "<style> table, th, td {border: 1px solid black;} </style>";

	print "<table><tr><th>WordID</th><th>Word</th></tr>";
	foreach ($conn->query($sql) as $row) {
		print "<tr>";
        print "<td>" . $row['WordID'] . "</td>";
        print "<td>" . $row['word'] . "</td>";
		print "</tr>";
    }
	print "</table>";



    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
