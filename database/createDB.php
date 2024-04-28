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

?>