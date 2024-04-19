<?php
class MyDB extends SQLite3 {
    function __construct() {
        $this->open('database.db');
    }
}

// Create a new instance of the database
$db = new MyDB();

// Check if the database opened successfully
if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully\n";
    
    // Create the userrole table
   $userroleTableQuery = "CREATE TABLE userrole (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           rolename VARCHAR NOT NULL
                          )";
    
   $articlecategoryTableQuery = "CREATE TABLE article_category (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           category VARCHAR NOT NULL
                          )";

   $itemcategoryTableQuery = "CREATE TABLE item_category (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           category VARCHAR NOT NULL
                          )";

   $employeeTableQuery = "CREATE TABLE employee (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           firstname VARCHAR NOT NULL,
                           middlename VARCHAR,
                           lastname VARCHAR NOT NULL,
                           position VARCHAR NOT NULL,
                           email VARCHAR NOT NULL,
                           gender VARCHAR NOT NULL,
                           contact VARCHAR
                        )";

   $inventoryTableQuery = "CREATE TABLE inventory (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           image LONGBLOB,
                           name VARCHAR NOT NULL,
                           category_id INTEGER,
                           value INTEGER NOT NULL,
                           quantity INTEGER NOT NULL,
                           dateadded VARCHAR NOT NULL,
                           datemodified VARCHAR NOT NULL,
                           FOREIGN KEY(category_id) REFERENCES item_category(id)
                        )";

   $articlesTableQuery = "CREATE TABLE articles (
                           id INTEGER PRIMARY KEY AUTOINCREMENT,
                           employee_id INTEGER,
                           title VARCHAR NOT NULL,
                           category_id INTEGER,
                           author VARCHAR NOT NULL,
                           description VARCHAR NOT NULL,
                           FOREIGN KEY(category_id) REFERENCES article_category(id)
                           FOREIGN KEY(employee_id) REFERENCES employee(id)
                        )";                        

   $credentialsTableQuery = "CREATE TABLE credentials (
                               id INTEGER PRIMARY KEY AUTOINCREMENT,
                               employee_id INTEGER,
                               username VARCHAR,
                               password VARCHAR,
                               datecreated VARCHAR,
                               role_id INTEGER,
                               FOREIGN KEY(role_id) REFERENCES userrole(id),
                               FOREIGN KEY(employee_id) REFERENCES employee(id)
                              )";

    // Execute the query
    $Result = $db->exec($userroleTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "userrole table created successfully\n";
    }

    $Result = $db->exec($articlecategoryTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "article category table created successfully\n";
    }

    $Result = $db->exec($itemcategoryTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "item category table created successfully\n";
    }

    $Result = $db->exec($employeeTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "employee table created successfully\n";
    }

    $Result = $db->exec($inventoryTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "inventory table created successfully\n";
    }

    $Result = $db->exec($articlesTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "articles table created successfully\n";
    }

    $Result = $db->exec($credentialsTableQuery);
    
    if (!$Result) {
        echo $db->lastErrorMsg();
    } else {
        echo "credentials category table created successfully\n";
    }
}

// Close the database connection
$db->close();
?>
