<?php
/*
    note:
    read steps in connectDB.php
*/

    include 'connectDB.php';

    // increase max_allowed_packet size dynamically ( we can use this if maglalagay tayo images )
        // $increase_packet_size_query = "SET GLOBAL max_allowed_packet = 67108864"; // 64 MB

    // create DONORS table
    
    $create_donors_table = "CREATE TABLE IF NOT EXISTS Donors (
            DonorID INT(11) AUTO_INCREMENT PRIMARY KEY,
            DonorName VARCHAR(255) NOT NULL,
            DonorNum VARCHAR(255) NOT NULL,
            DonorEmail VARCHAR(255) NOT NULL
        )";
    try {
        $pdo_obj->exec($create_donors_table);
        echo "Donrs table created successfully.";
    } catch(PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

    // create DONATIONS table
    $create_donations_table = "CREATE TABLE IF NOT EXISTS Donations (
            ItemID INT(11) AUTO_INCREMENT PRIMARY KEY,
            ItemName VARCHAR(255) NOT NULL,
            ItemDescription VARCHAR(255) NOT NULL,
            ItemQty INT(11) NOT NULL,
            ItemCategory VARCHAR(255) NOT NULL,
            ItemDateRec DATE NOT NULL,
            ItemDonorID INT(11) NOT NULL,
            ItemRemarks VARCHAR(255) NOT NULL,
            FOREIGN KEY (ItemDonorID) REFERENCES Donors(DonorID)
        )";
    try {
        $pdo_obj->exec($create_donations_table);
        echo "Donations table created successfully.";
    } catch(PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

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


?>