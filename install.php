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
//the .= is needed to concatenate or merge togheter the tqo $sql
// request the one dropping and creating the table with the one inserting
// new values into the table

$sql .= "
INSERT INTO courses(kurskod,kursnamn,progression,kursplan) 
VALUES
('DT084G', ' Introduktion till programmering i JavaScript', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30554'),
('DT163G', 'Digital bildbehandling för webb', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=24403'),
('DT068G', 'Webbanvändbarhet', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30563'),
('DT057G', 'Webbutveckling I', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782'),
('DT173G', 'Webbutveckling III', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22706'),
('DT093G', 'Webbutveckling II', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27133'),
('DT003G', 'Databaser', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=21595'),
('IK060G', 'Projektledning', 'A', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=27003'),
('GD008G', 'Typografi och form för webb', 'A', 'https://www.google.com/url?client=internal-element-cse&cx=015190983368593144054:kq6-drsmbqy&q=https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/Print/%3Fkursplanid%3D14739&sa=U&ved=2ahUKEwjD-r2OhbvzAhVv-ioKHcDiCwwQFnoEC'),
('DT197G', 'Webbdesign för CMS', 'B', 'https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=30728')
";

echo "<pre>$sql</pre>";

if ($db->multi_query($sql)) {
    echo "<p>Tabbeller installerades</p>";
} else {
    echo "<p class='error'>Fel vid installation</p>";
}
