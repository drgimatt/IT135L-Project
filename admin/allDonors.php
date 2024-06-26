<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors</title>
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

    <div class="container mt-5" style="max-width: 1400px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="green mb-1" style="font-weight:bold">All Donors</h2>
        <a class="btn btn-green" href="./addDonors.php">Add Donor</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mt-1">
            <thead>
                <tr>
                    <th>Donor ID</th>
                    <th>Donor Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // include database connection
                include '../database/connectDB.php';

                // fetch all donors
                $stmt = $pdo_obj->query("SELECT * FROM Donors");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['DonorID']}</td>";
                    echo "<td>{$row['DonorName']}</td>";
                    echo "<td>{$row['DonorNum']}</td>";
                    echo "<td>{$row['DonorEmail']}</td>";
                    echo "<td> <a href='updateDonor.php?id={$row['DonorID']}'><button class='btn btn-ol-teal btn-sm'>Update</button></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
    <!-- Footer -->
    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #7FCE46 !important; color: white;">
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
