<?php
    // include database connection file
    include '../database/connectDB.php';

        if (isset($_GET['id']))
        {
            $item_ID = $_GET['id'];

            $deleteRecord = "DELETE FROM Donations WHERE ItemID = :item_ID";

            $stmt = $pdo_obj->prepare($deleteRecord);
            $stmt->execute(['item_ID' => $item_ID]);

        if($stmt->rowCount() > 0) {
            // redirect back to the page displaying all donations
            header("Location: ./allDonations.php");
            exit();
        } 
        else 
        {
            echo "Failed to delete the Donation.";
        }
        } 
        else 
        {
            echo "Invalid Donation ID.";
        }

?>
