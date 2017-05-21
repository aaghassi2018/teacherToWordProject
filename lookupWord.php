<html>
<head><title>lookupWord</title></head>
<style>
  table{
    border-collapse: collapse;
  }
  th,td {
    text-align: left;
    padding:8px;
  }
  tr:nth-child(even){background-color: #f2f2f2}
</style>
<body>

<h1>Lookup Word</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=words", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	print "<p>" . $_GET['word'] . " is associated with: </p>";

	$word = $conn->query("SELECT * FROM Words WHERE word = '$_GET[word]'");
	$wordresult = $word -> fetch();


  $yo = "SELECT * FROM TeacherToWord WHERE wordid = $wordresult[WordID] ORDER BY TeacherToWord.count DESC";

	print "<style> table, th, td {border: 1px solid black;} </style>";

	print "<table><tr><th>Teacher</th><th>count</th></tr>";
	foreach ($conn->query($yo) as $row) {
    $teacherlookup = $conn->query("SELECT * FROM Teachers WHERE TeacherID = '$row[TeacherID]'");
    $teacherlookupresult = $teacherlookup -> fetch();

		print "<tr>";
				print "<td>" . $teacherlookupresult['TeacherName'] . "</td>";
        print "<td>" . $row['count'] . "</td>";
		print "</tr>";
    }
	print "</table>";


    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
    //echo "That word is not in our database.";
    }
?>
