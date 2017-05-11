<html>
<head><title>insertPair</title></head>

<body>

<h1>Insert Pair</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=words", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$teacherlookup = $conn->query("SELECT * FROM Teachers WHERE TeacherName = '$_GET[teacherName]'");
	$teacherlookupresult = $teacherlookup -> fetch();

  $wordlookup = $conn->query("SELECT * FROM words WHERE word = '$_GET[word]'");
	$wordlookupresult = $wordlookup -> fetch();

  if($wordlookupresult['WordID'] == 0) {
    print "<p>Inserted new word into words database</p>";
    $sql = "INSERT INTO words (WordID,word) VALUES ('','$_GET[word]')";
    $conn->exec($sql);
  } else {
      //print "<p>Word was already found in words database</p>";
  }

  if($teacherlookupresult['TeacherID'] == 0) {
    print "<p>Inserted new teacher into teachers database</p>";
    $sql = "INSERT INTO Teachers (TeacherID,TeacherName) VALUES ('','$_GET[teacherName]')";
    $conn->exec($sql);
  } else {
      //print "<p>Teacher was already found in teachers database</p>";
  }

  $newteacherlookup = $conn->query("SELECT * FROM Teachers WHERE TeacherName = '$_GET[teacherName]'");
	$newteacherlookupresult = $newteacherlookup -> fetch();

  $newwordlookup = $conn->query("SELECT * FROM words WHERE word = '$_GET[word]'");
	$newwordlookupresult = $newwordlookup -> fetch();

  $seeIfRowExists = $conn->query("SELECT Count(*) FROM TeacherToWord WHERE TeacherID = '$newteacherlookupresult[TeacherID]' AND WordID = '$newwordlookupresult[WordID]'");
  $seeIfRowExistsResult = $seeIfRowExists -> fetch();

  if($seeIfRowExistsResult[0] == 0){
    $lalala = "INSERT INTO TeacherToWord (TeacherID,WordID,count) VALUES ('$newteacherlookupresult[TeacherID]','$newwordlookupresult[WordID]',1)";
    $conn->exec($lalala);
    print "<h3>".$newteacherlookupresult['TeacherName']." is now associated with ".$newwordlookupresult['word']. " 1 time.";
  }
  else{
    //edit existing row
    $idk = $conn->query("UPDATE TeachertoWord SET count = count + 1 WHERE TeacherID = '$newteacherlookupresult[TeacherID]' AND WordID = '$newwordlookupresult[WordID]'");

    $howMany = $conn->query("SELECT * FROM TeachertoWord WHERE TeacherID = '$newteacherlookupresult[TeacherID]' AND WordID = '$newwordlookupresult[WordID]'");
    $howManyResult = $howMany -> fetch();

    print "<h3>".$newteacherlookupresult['TeacherName']." is now associated with ".$newwordlookupresult['word']. " " . $howManyResult['count'] . " times.";
  }

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
