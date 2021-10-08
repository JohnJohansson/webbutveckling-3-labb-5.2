<?php
// an installation file to install my database easily 
include("includes/config.php");

// databas anslutning
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE); //Connects to the database
if ($db->connect_errno > 0) { //
    die("Fel vid anslutning: " . $db->connect_error);
}
// SQL-FRÅGA för att skapa tabel courses
$sql = "DROP TABLE IF EXISTS courses;
   CREATE TABLE courses(id INT(11) PRIMARY KEY AUTO_INCREMENT, 
   kurskod VARCHAR(255) NOT NULL, 
   kursnamn VARCHAR(255) NOT NULL, 
   progression VARCHAR(2) NOT NULL, 
   kursplan VARCHAR(255), 
   datum TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);";

// Insert into the tabel courses

$sql = "
INSERT INTO courses(kurskod,kursnamn,progression,kursplan) VALUES('DT173G','Webbutveckling III','B','https://elearn20.miun.se/moodle/course/view.php?id=10199')
";

echo "<pre>$sql</pre>";

if ($db->multi_query($sql)) {
    echo "<p>Tabbeller installerades</p>";
} else {
    echo "<p class='error'>Fel vid installation</p>";
}
