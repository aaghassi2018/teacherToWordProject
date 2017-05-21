<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title> Teacher to Word Interface </title>
</head>
<body>

<div class="container">

<header>
   <h1>Teacher to Word Interface</h1>
</header>

<nav>
    <form action="JavaScript:insertPair()" method="get" style="width:280px;" name="insertPair">
      <fieldset>
        <legend><span style="font-weight:bold;">New "Teacher-Word Pair"</span></legend>
        Teacher:<br>
        <input type="text" name="teacherName" value="">
        <br>
        Word:<br>
        <input type="text" name="word" value="">
        <br><br>
        <input type="submit" value="Submit">
      </fieldset>
    </form>
    <br>
    <form action="JavaScript:lookupWord()" method="get" style="width:280px;" name="lookupWord">
      <fieldset>
        <legend><span style="font-weight:bold;">Lookup Word</span></legend>
        Word:<br>
        <input type="text" name="word" value="">
        <br><br>
        <input type="submit" value="Submit">
      </fieldset>
    </form>
    <br>
    <form action="JavaScript:lookupTeacher()" method="get" style="width:280px;" name="lookupTeacher">
      <fieldset>
        <legend><span style="font-weight:bold;">Lookup Teacher</span></legend>
        Teacher Name:<br>
        <input type="text" name="teacherName" value="">
        <br><br>
        <input type="submit" value="Submit">
      </fieldset>
    </form>
    <br>
    <input type="submit" value="Get List of All Registered Teachers" onclick="getAllTeachers()">
    <br>
    <br>
    <input type="submit" value="Get List of All Registered Words" onclick="getAllWords()">
</nav>


<article>
  <div id="result">

  </div>
</article>


</div>

</body>
</html>


<script>
function getAllTeachers() {
	//alert("about to request page");
  httpGetAsync("http://localhost/teacherToWordProject/getAllTeachers.php",processPage);
}
function getAllWords() {
	//alert("about to request page");
  httpGetAsync("http://localhost/teacherToWordProject/getAllWords.php",processPage);
}

function lookupTeacher() {
	//alert("about to request page");
  var bruh = "http://localhost/teacherToWordProject/lookupTeacher.php?teacherName=";
  var bro = document.lookupTeacher['teacherName'].value;
  var yo = bruh.concat(bro);
  httpGetAsync(yo, processPage);

}
function lookupWord() {
	//alert("about to request page");
  var bruh = "http://localhost/teacherToWordProject/lookupWord.php?word=";
  var bro = document.lookupWord['word'].value;
  var yo = bruh.concat(bro);
  httpGetAsync(yo, processPage);

}

function insertPair() {
	//alert("about to request page");
  var bruh = "http://localhost/teacherToWordProject/insertPair.php?teacherName=";
  var bro = document.insertPair['teacherName'].value;
  var yo = bruh.concat(bro);
  var word = document.insertPair['word'].value;
  var result = yo.concat("&word=");
  var actualResult = result.concat(word);
  httpGetAsync(actualResult, processPage);

}
function deleteOne(x, y){
  var bruh = "http://localhost/teacherToWordProject/deleteTeacher.php?TeacherID=";
  var yo = bruh.concat(x);
  var result = yo.concat("&WordID=");
  var actualResult = result.concat(y);
  httpGetAsync(actualResult, processPage);
}

//starts a request and then runs the callback method when it is loaded
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
