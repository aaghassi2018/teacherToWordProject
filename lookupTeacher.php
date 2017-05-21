<html>
<head><title>lookupTeacher</title></head>
<style>
  table{
    border-collapse: collapse;
  }
  th,td {
    text-align: left;
    padding:8px;
  }
  tr:nth-child(even){background-color: #f2f2f2}
  #bro{
    padding: 10px;
  }
</style>
<body>

<h1>Lookup Teacher</h1>
<div id="result">
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=words", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = $conn->query("SELECT * FROM Teachers WHERE TeacherName = '$_GET[teacherName]'");
	$sqlresult = $sql -> fetch();


  if($sqlresult['TeacherName'] == null){
    print "<h1>no teacher found with the name \"". $_GET['teacherName'] . "\"</h1>";
  }
  else {
    print "<p>" . $sqlresult['TeacherName'] . " is associated with: </p>";
  }

  $yo = "SELECT * FROM TeacherToWord WHERE TeacherID = '$sqlresult[TeacherID]' ORDER BY TeacherToWord.count DESC";

	print "<style> table, th, td {border: 1px solid black;} </style>";

	print "<table><tr><th>Word</th><th>count</th></tr>";
	foreach ($conn->query($yo) as $row) {
    $wordlookup = $conn->query("SELECT * FROM words WHERE wordid = $row[WordID]");
    $wordlookupresult = $wordlookup -> fetch();


		print "<tr>";
				print "<td>" . $wordlookupresult[1] . "</td>";
        print "<td>" . $row['count'] . "</td>";
        print "<td id=\"bro\"> <input type=\"submit\" value=\"Delete One Entry\" onclick=\"deleteOne('$sqlresult[TeacherID]','$row[WordID]')\"> </td>";
		print "</tr>";

    }
	print "</table>";


    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
    //echo "That teacher is not in our database.";
    }
?>
</body>
<script>
  function deleteOne(x, y){
    var bruh = "http://localhost/teacherToWordProject/deleteTeacher.php?TeacherID=";
    var yo = bruh.concat(x);
    var result = yo.concat("&WordID=");
    var actualResult = result.concat(y);
    httpGetAsync(actualResult, processPage);
  }
  function httpGetAsync(theUrl, callbackWhenPageLoaded)
  {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function() {
          if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
              callbackWhenPageLoaded(xmlHttp.responseText);
      }
      xmlHttp.open("GET", theUrl, true); // true for asynchronous
      xmlHttp.send(null);
  }



  //This callback method is a bit boring as it just prints to the console.
  //Add more fun or call another method from inside to do something interesting.
  function processPage(responseText) {
  	document.getElementById("result").innerHTML = responseText;
  	//alert(responseText);
  }
</script>
