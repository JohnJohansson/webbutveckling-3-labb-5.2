<?php
// a config file for the database connection

// Aktivera felrapportering (ta bort innan sidan laddas upp)
error_reporting(-1);
ini_set("display_errors", 1);

// auto lodes the classes
spl_autoload_register(function ($class_name){
    include 'classes/' . $class_name . '.class.php';
});

    // Database settings localhost
    define("DBHOST", 'localhost'); //host
    define("DBUSER", 'NyTest'); //name of user
    define("DBPASS", 'pass'); //password 
    define("DBDATABASE", 'rest_databas'); //name of database
