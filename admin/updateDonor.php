<?php
    $statusMessage = "";

    // include database files
    include '../database/connectDB.php';

    // initialize variables
    $donorID = "";
    $donorName = "";
    $donorNum = "";
    $donorEmail = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $getRecord = "SELECT * FROM Donors WHERE DonorID = :donor_id";
        $stmt = $pdo_obj->prepare($getRecord);
        $stmt->bindParam(':donor_id', $id);
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
        $donorName = $_POST["donorName"];
        $donorNum = $_POST["donorNum"];
        $donorEmail = $_POST["donorEmail"];

        // update query
        $updateQuery = "UPDATE Donors SET DonorName = :donorName, DonorNum = :donorNum, DonorEmail = :donorEmail WHERE DonorID = :donorID";
        $stmt = $pdo_obj->prepare($updateQuery);
        $stmt->bindParam(':donorName', $donorName);
        $stmt->bindParam(':donorNum', $donorNum);
        $stmt->bindParam(':donorEmail', $donorEmail);
        $stmt->bindParam(':donorID', $donorID);

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
    <title>Update Donor</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="./allDonations.php">Donations</a>
                </li>
                <li class="nav-item active">
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
            <h2 class="green text-center mb-4" style="font-weight:bold">Update Donor Info</h2>
            <div class="card shadow" style="width: 100%">
                <div class="card-body">
                    <form id="updateForm" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="donorName">Donor Name</label>
                            <input type="text" class="form-control" id="donorName" name="donorName" value="<?php echo $donorName; ?>">
                        </div>
                        <div class="form-group">
                            <label for="donorNum">Donor's Contact Number</label>
                            <input type="text" class="form-control" id="donorNum" name="donorNum" value="<?php echo $donorNum; ?>">
                        </div>
                        <div class="form-group">
                            <label for="donorEmail">Donor Email</label>
                            <input type="email" class="form-control" id="donorEmail" name="donorEmail" value="<?php echo $donorEmail; ?>">
                        </div>
                        <!-- submit the form -->
                        <div class="submitbutton text-center">
                            <button type="submit" class="btn btn-green" style="width: 200px; margin-bottom: 20px;">Save</button>
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
        window.location.href = "./allDonors.php"; 
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