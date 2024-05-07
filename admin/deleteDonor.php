<?php
    // include database connection file
    include '../database/connectDB.php';

        if (isset($_GET['id']))
        {
            $donor_ID = $_GET['id'];

            $deleteRecord = "DELETE FROM Donors WHERE DonorID = :donor_ID";

            $stmt = $pdo_obj->prepare($deleteRecord);
            $stmt->execute(['donor_ID' => $donor_ID]);

        if($stmt->rowCount() > 0) {
            // redirect back to the page displaying all donors
            header("Location: ./allDonors.php");
            exit();
        } 
        else 
        {
            echo "Failed to delete the Donor.";
        }
        } 
        else 
        {
            echo "Invalid Donor ID.";
        }

?>