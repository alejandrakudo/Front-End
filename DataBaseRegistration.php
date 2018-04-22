<?php
/* Process the form data to get the course ID and access the database to find the information. */

$name = $_POST["cName"];   /*retrieve the course id */
$phone = $_POST["phone"];
$postal_code = $_POST["pCode"];
$email = $_POST["email"];
$profession = $_POST["Profession"];
$location = $_POST["location"];
$accomodation = $_POST["yes"];
$sessions = $_POST["session"];

try {
   /* Create a connection with the database */
   $dbh = new PDO('mysql:host=localhost;dbname=registrar', 'root', '282mysql');

   /* Turn on error checking */
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   /* Issue a query */
   $rows = $dbh->query("select id, name, phone, code, email, profession, location, accomodation");
   
   /* Process the results */
   foreach ($rows as $row) {
     echo "<p>Name: ".$row["cName"]."<br>";
     echo "Phone Numer: ".$row["phone"]."<br>";
     echo "Postal Code: ".$row["pCode"]."<br>";
     echo "Email:" .$row["email"]."<br>";
     echo "Profession:" .$row["Profession"]."<br>";
     echo "Transportation Location:" .$row["location"]."<br>";
     echo "Accomocation:" .$row["yes"]."</p>";
   }

   /* Issue another query  and process the results */
   $rows = $dbh->query("select id, SessionName, MaxAttendance, SpeakerName, Location");

   foreach ($rows as $row) {
     echo "<p>Session Name: ".$row[0]."<br>"; 
     echo "Max Attendance: ".$row[1]."<br>";
     echo "Speaker Name:" .$row[2]."<br>";
     echo "Location:" .$row[3]."</p>";
   }



   $howManyRows = $dbh->exec("update course set name = '$newName' where id = '$cid'");
   echo "I have updated ".$howManyRows." rows";



   $dbh = null;


} catch (PDOException $e) {
      echo $e->getMessage();
      die();
}

?>

</body>
</html>