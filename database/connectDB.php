

    <!-- steps:
    1. make sure mySQL is running sa XAMPP
    2. go to localhost/phpmyadmin/
    3. create a db named KOBInventory
    4. go to localhost/IT135L-Project/database/connectDB.php
    5. go to localhost/IT135L-Project/database/createDB.php
    6. go to localhost/IT135L-Project/database/createEntries.php (preloaded entries lang ito) -->


<?php
    $host = 'localhost:3310';
    $user = 'root';
    $password = 'titingkayad';
    $dbname = 'KOBInventory';

    // Create a PDO instance with a connection to MySQL server
    try {
        $pdo_obj = new PDO("mysql:host=$host", $user, $password);
        $pdo_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create the database if it doesn't exist
        
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $pdo_obj->exec($sql);
        
        // Switch to the created database
        $pdo_obj->exec("USE $dbname");
        
        // Success message
        error_log("Connection successful.");
    } catch(PDOException $e) {
        echo "Connection unsuccessful. " . $e->getMessage(); 
        error_log("Connection unsuccessful: " . $e->getMessage());
    }
?>
