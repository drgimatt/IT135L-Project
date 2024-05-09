<?php
    $statusMessage = "";

    // include database files
    include '../database/connectDB.php';

    // initialize variables
    $donorID = "";
    $donorName = "";
    $donorNum = "";
    $donorEmail = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        try {        
        $donorName = $_POST["donorName"];
        $donorNum = $_POST["donorNum"];
        $donorEmail = $_POST["donorEmail"];

        //insert donor data into table
        $insertDonor = "INSERT INTO Donors (DonorName, DonorNum, DonorEmail) VALUES (?, ?, ?)";
        $stmtDonor = $pdo_obj->prepare($insertDonor);
        $stmtDonor->bindParam(1, $donorName);
        $stmtDonor->bindParam(2, $donorNum);
        $stmtDonor->bindParam(3, $donorEmail);
    
        if ($stmtDonor->execute()) {
            $statusMessage = "Successfully added.";
            echo "<script>alert('$message');</script>";
            header("Location: ./allDonors.php");
            exit;
        } else {
            $statusMessage = "Failed to add donor.";
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
    <title>Add Donor</title>
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
            <h2 class="green text-center mb-4" style="font-weight:bold">Add Donor Info</h2>
            <div class="card shadow" style="width: 100%">
                <div class="card-body">
                    <form id="updateForm" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="donorName">Donor Name</label>
                            <input type="text" class="form-control" id="donorName" name="donorName"  required>
                        </div>
                        <div class="form-group">
                            <label for="donorNum">Donor's Contact Number</label>
                            <input type="text" class="form-control" id="donorNum" name="donorNum" required>
                        </div>
                        <div class="form-group">
                            <label for="donorEmail">Donor Email</label>
                            <input type="email" class="form-control" id="donorEmail" name="donorEmail" required>
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