<?php
/*
    steps:
    1. make sure mySQL is running sa XAMPP
    2. go to localhost/phpmyadmin/
    3. create a db named KOBInventory
    4. go to localhost/IT135L-Project/database/connectDB.php
    5. go to localhost/IT135L-Project/database/createDB.php
    6. go to localhost/IT135L-Project/database/createEntries.php (preloaded entries lang ito)
*/

    $db = "mysql:host=112.205.159.209:3310;dbname=KOBInventory";

    $user = "admin";
    $password = "titingkayad";

    try {
        $pdo_obj = new PDO($db, $user, $password);
        $pdo_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        error_log("Connection successful.");

    } catch(PDOException $e) {
        echo "Connection unsuccessful. " . $e->getMessage(); 
        error_log("Connection unsuccessful: " . $e->getMessage());
    }
?>