<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('database.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n\n";
      
      // Create userrole table
      $query = "CREATE TABLE IF NOT EXISTS userrole (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    rolename VARCHAR NOT NULL
                )";
      $result = $db->exec($query);
      if (!$result) {
          echo "Error creating userrole table: " . $db->lastErrorMsg();
      } else {
          echo "Userrole table created successfully\n";
      }
   }
?>
