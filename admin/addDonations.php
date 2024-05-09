<?php
    $statusMessage = "";

    // include database files
    include '../database/connectDB.php';

    // initialize variables
    $itemID = "";
    $itemName = "";
    $itemDesc = "";
    $itemQty = "";
    $itemCat = "";
    $itemDate = "";
    $itemDonor = "";
    $itemRem = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // retrieve form data
        try {        
            $itemName = $_POST["itemName"];
            $itemDesc = $_POST["itemDesc"];
            $itemQty = $_POST["itemQty"];
            $itemCat = $_POST["itemCat"];
            $itemDate = $_POST["itemDate"];
            $itemDonor = $_POST["itemDonor"];
            $itemRem = $_POST["itemRem"];
    
            //insert donor data into table
            $insertDonation = "INSERT INTO Donations (ItemName, ItemDescription, ItemQty, ItemCategory, ItemDateRec, ItemDonorID, ItemRemarks) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtDonation = $pdo_obj->prepare($insertDonation);
            $stmtDonation->bindParam(1, $itemName);
            $stmtDonation->bindParam(2, $itemDesc);
            $stmtDonation->bindParam(3, $itemQty);
            $stmtDonation->bindParam(4, $itemCat);
            $stmtDonation->bindParam(5, $itemDate);
            $stmtDonation->bindParam(6, $itemDonor);
            $stmtDonation->bindParam(7, $itemRem);
        
            if ($stmtDonation->execute()) {
                $statusMessage = "Successfully added.";
                echo "<script>alert('$message');</script>";
                header("Location: ./allDonations.php");
                exit;
            } else {
                $statusMessage = "Failed to add donations.";
                echo "<script>alert('$message');</script>";
            }
    
        } catch (PDOException $e) {
            echo "Failed to add entries: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donation</title>
    <link rel="icon" href="../assets/favicon.ico">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./admin.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand">
            <img src="../assets/logomain.png" height="40px" alt="Your Logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./allDonations.php">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./allDonors.php">Donors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./articleDashboard.php">Articles</a>
                </li>
            </ul>
        </div>
       
        <a class="btn btn-teal ml-2" href="./adminLogoff.php">Logout</a>
    </nav>

    
    <br>
    <br>
    <br>
    <br>

<!-- form start -->
<div class="container-event">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="pink text-center mb-4" style="font-weight:bold">Add Donation Info</h2>
            <div class="card shadow" style="width: 100%">
                <div class="card-body">
                    <form id="updateForm" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="itemName">Item Name</label>
                            <input type="text" class="form-control" id="itemName" name="itemName" value="<?php echo $itemName; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="itemDesc">Item Description</label>
                            <input type="text" class="form-control" id="itemDesc" name="itemDesc" value="<?php echo $itemDesc; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="itemQty">Item Quantity</label>
                            <input type="text" class="form-control" id="itemQty" name="itemQty" value="<?php echo $itemQty; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="itemCat">Item Category</label>
                            <input type="text" class="form-control" id="itemCat" name="itemCat" value="<?php echo $itemCat; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="itemDate">Item Date Received</label>
                            <input type="date" class="form-control" id="itemDate" name="itemDate" value="<?php echo $itemDate; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="itemDonor">Donor</label>
                            <select class="form-control" id="itemDonor" name="itemDonor">
                                <?php
                                // Your database connection code
                                include '../database/connectDB.php';

                                // SQL query to fetch donor IDs and names
                                $sql = "SELECT DonorID, DonorName FROM Donors";
                                $stmt = $pdo_obj->query($sql);

                                // Loop through the results to create options for the select dropdown
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $donorID = $row['DonorID'];
                                    $donorName = $row['DonorName'];
                                    echo "<option value='$donorID'>$donorID - $donorName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemRem">Item Remarks</label>
                            <input type="text" class="form-control" id="itemRem" name="itemRem" value="<?php echo $itemRem; ?>" required>
                        </div>
                        <!-- submit the form -->
                        <div class="submitbutton text-center">
                            <button type="submit" class="btn btn-pink" style="width: 200px; margin-bottom: 20px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- form end -->



<script>
    // show alert on successful update
    <?php if (!empty($statusMessage)): ?>
        alert("<?php echo $statusMessage; ?>");
        window.location.href = "./allDonations.php"; 
    <?php endif; ?>
</script>

<br>
<br>
<br>
<br>
<br>
<br>
    <!-- Footer -->
    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #FF1F99 !important; color: white;">
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy; Kids of Bataan
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>