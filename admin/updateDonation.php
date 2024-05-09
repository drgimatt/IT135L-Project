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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $getRecord = "SELECT * FROM Donations WHERE ItemID = :donation_id";
        $stmt = $pdo_obj->prepare($getRecord);
        $stmt->bindParam(':donation_id', $id);
        $stmt->execute();
        $donation = $stmt->fetch(PDO::FETCH_ASSOC);

        // extract values from the fetched donation record
        if ($donation) {
            $itemID = $donation['ItemID'];
            $itemName = $donation['ItemName'];
            $itemDesc = $donation['ItemDescription'];
            $itemQty = $donation['ItemQty'];
            $itemCat = $donation['ItemCategory'];
            $itemDate = $donation['ItemDateRec'];
            $itemDonor = $donation['ItemDonorID'];
            $itemRem = $donation['ItemRemarks'];
        }

        $getRecord = "SELECT * FROM Donors WHERE DonorID = :donor_id";
        $stmt = $pdo_obj->prepare($getRecord);
        $stmt->bindParam(':donor_id', $itemDonor);
        $stmt->execute();
        $donor = $stmt->fetch(PDO::FETCH_ASSOC);

        // extract values from the fetched donor record
        if ($donor) {
            $donorID = $donor['DonorID'];
            $donorName = $donor['DonorName'];
            $donorNum = $donor['DonorNum'];
            $donorEmail = $donor['DonorEmail'];
        }

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // retrieve form data
        $itemName = $_POST["itemName"];
        $itemDesc = $_POST["itemDesc"];
        $itemQty = $_POST["itemQty"];
        $itemCat = $_POST["itemCat"];
        $itemDate = $_POST["itemDate"];
        $itemRem = $_POST["itemRem"];

        // update query
        $updateQuery = "UPDATE Donations SET ItemName = :itemName, ItemDescription = :itemDesc, ItemQty = :itemQty, ItemCategory = :itemCat, ItemDateRec = :itemDate, ItemDonorID = :itemDonor, ItemRemarks = :itemRem WHERE ItemID = :itemID";
        $stmt = $pdo_obj->prepare($updateQuery);
        $stmt->bindParam(':itemName', $itemName);
        $stmt->bindParam(':itemDesc', $itemDesc);
        $stmt->bindParam(':itemQty', $itemQty);
        $stmt->bindParam(':itemCat', $itemCat);
        $stmt->bindParam(':itemDate', $itemDate);
        $stmt->bindParam(':itemDonor', $itemDonor);
        $stmt->bindParam(':itemRem', $itemRem);
        $stmt->bindParam(':itemID', $itemID);

        if ($stmt->execute()) {
            $statusMessage = "Successfully updated.";
        } else {
            $statusMessage = "Failed to update.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Donation</title>
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
            <h2 class="pink text-center mb-4" style="font-weight:bold">Update Donation Info</h2>
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
                            <input type="text" class="form-control" id="itemDonor" name="itemDonor" value="<?php echo "$itemDonor - $donorName"; ?>" readonly>
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