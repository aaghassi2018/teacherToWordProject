<html>
<head><title>lookupTeacher</title></head>

<body>

<h1>Lookup Teacher</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=words", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	print "<p>" . $_GET['teacherName'] . " is associated with: </p>";

	$sql = $conn->query("SELECT * FROM Teachers WHERE TeacherName = '$_GET[teacherName]'");
	$sqlresult = $sql -> fetch();


  $yo = "SELECT * FROM TeacherToWord WHERE TeacherID = '$sqlresult[TeacherID]'";

	print "<style> table, th, td {border: 1px solid black;} </style>";

	print "<table><tr><th>Word</th><th>count</th></tr>";
	foreach ($conn->query($yo) as $row) {
    $wordlookup = $conn->query("SELECT * FROM words WHERE wordid = $row[WordID]");
    $wordlookupresult = $wordlookup -> fetch();

		print "<tr>";
				print "<td>" . $wordlookupresult[1] . "</td>";
        print "<td>" . $row['count'] . "</td>";
		print "</tr>";
    }
	print "</table>";


    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
