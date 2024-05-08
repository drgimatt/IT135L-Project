<?php
    // include database connection file
    include '../database/connectDB.php';

        if (isset($_GET['id']))
        {
            $art_ID = $_GET['id'];

            $deleteRecord = "DELETE FROM Articles WHERE ID = :art_ID";

            $stmt = $pdo_obj->prepare($deleteRecord);
            $stmt->execute(['art_ID' => $art_ID]);

        if($stmt->rowCount() > 0) {
            // redirect back to the page displaying all donations
            header("Location: ./articleDashboard.php");
            exit();
        } 
        else 
        {
            echo "Failed to delete the Article.";
        }
        } 
        else 
        {
            echo "Invalid Article ID.";
        }

?>
