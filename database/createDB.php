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
        echo "Donors table created successfully.";
    } catch(PDOException $e) {
        echo "\nError Donors creating table: " . $e->getMessage();
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
        echo "\nError Donations creating table: " . $e->getMessage();
    }

    $articlecategoryTableQuery = "CREATE TABLE IF NOT EXISTS Article_Category (
        ID INTEGER AUTO_INCREMENT PRIMARY KEY,
        Category VARCHAR(255) NOT NULL
    )";

    try {
        $pdo_obj->exec($articlecategoryTableQuery);
        echo "Article Category table created successfully.";
    } catch(PDOException $e) {
        echo "\nError creating Article Category table: " . $e->getMessage();
    }

    $employeeTableQuery = "CREATE TABLE IF NOT EXISTS Employees (
        ID INTEGER PRIMARY KEY,
        FirstName VARCHAR(255) NOT NULL,
        MiddleName VARCHAR(255),
        LastName VARCHAR(255) NOT NULL,
        Position VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Gender VARCHAR(255) NOT NULL,
        ContactNumber VARCHAR(255)
    )";

    try {
        $pdo_obj->exec($employeeTableQuery);
        echo "Employee table created successfully.";
    } catch(PDOException $e) {
        echo "\nError creating Employee table: " . $e->getMessage();
    }

    $articlesTableQuery = "CREATE TABLE IF NOT EXISTS Articles (
        ID INTEGER AUTO_INCREMENT PRIMARY KEY,
        EmployeeID INTEGER NOT NULL,
        Title VARCHAR(255) NOT NULL,
        CategoryID INTEGER NOT NULL,
        Content VARCHAR(255) NOT NULL,
        Picture LONGBLOB,
        DateCreated DATE NOT NULL,
        AStatus VARCHAR(255) NOT NULL,
        FOREIGN KEY(CategoryID) REFERENCES Article_Category(ID),
        FOREIGN KEY(EmployeeID) REFERENCES Employees(ID)
    )";                        

    try {
        $pdo_obj->exec($articlesTableQuery);
        echo "Articles table created successfully.";
    } catch(PDOException $e) {
        echo "\nError creating Articles table: " . $e->getMessage();
    }

    $credentialsTableQuery = "CREATE TABLE IF NOT EXISTS Credentials (
        ID INTEGER AUTO_INCREMENT PRIMARY KEY,
        EmployeeID INTEGER NOT NULL,
        Username VARCHAR(255) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        DateCreated DATE NOT NULL,
        FOREIGN KEY(EmployeeID) REFERENCES Employees(id)
    )";

    try {
        $pdo_obj->exec($credentialsTableQuery);
        echo "Credentials table created successfully.";
    } catch(PDOException $e) {
        echo "\nError creating Credentials table: " . $e->getMessage();
    }

?>