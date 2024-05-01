<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/favicon.ico">
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
    <a class="navbar-brand" href="#">
        <img src="../assets/logo-main.png" height="50px" alt="Your Logo">
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-green ml-2" href="../user/index.html">Return</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-6 logo-container">
                            <img src="../assets/logo.jpeg" alt="Logo" class="logo">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="mb-4">Login</h3>
                                <form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="loginForm">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-teal btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #FF1F99 !important; color: white;">
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy; Kids of Bataan
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </body>
</html>

<?php 

    include '../database/connectDB.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{

            $enteredUsername = $_POST['username'];
            $enteredPassword = $_POST['password'];
            $credentialsQuery = "SELECT * FROM credentials WHERE username = :username AND password = :password";
    
            $stmtCredentials = $pdo_obj->prepare($credentialsQuery);
            $stmtCredentials->bindParam(':username', $enteredUsername);
            $stmtCredentials->bindParam(':password', $enteredPassword);
            $stmtCredentials->execute();
    
            $result = $stmtCredentials->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                // Credentials match, do something
                header("Location: ./allDonations.php");
                exit;
            } else {
                // Credentials not found, do something else
                $message = "Invalid username or password. Please try again.";
                echo "<script>alert('$message');</script>";
                exit;
            }
    
        } catch (PDOException $e){
            echo "Failed to query database: " . $e->getMessage();
        }


    }

?>