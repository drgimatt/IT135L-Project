<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="../assets/favicon.ico">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="signin.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../assets/logomain.png" height="40px" alt="Your Logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-green ml-2" href="../user/index.html">Return</a>
                </li>
            </ul>
        </div>
    </nav>


<!-- Middle Part-->
        <!----------------------- Main Container -------------------------->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
           <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <!--------------------------- Left Box ----------------------------->
           <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #ffffff;">
            <div class="featured-image mb-3">
            <img src="../assets/logomain.png" alt="Kids of Bataan" class="img-fluid" style="width: 400px; border-radius: 30px; padding-top: 3%;">
        </div>
           </div> 
        <!-------------------- ------ Right Box ---------------------------->
            
           <div class="col-md-6 right-box">
              <div class="login-form">
              <div class="header-text mb-4">
                         <h1>LOGIN</h1>
                    </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="loginForm">
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" id="username" name="username" placeholder="Enter username" required>
                        <small class="text-muted">e.g juandelacruz</small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg btn-teal w-100 fs-6">LOGIN</button>
                    </div>
                    
                </form>
                
              </div>
           </div> 
          </div>
        </div>

        </body>


     <!-- Footer -->
     <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #FF1F99 !important; color: white;">
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy; Kids of Bataan
        </div>
        <!-- Copyright -->
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    
</html>

<?php 

    include '../database/connectDB.php';
    
    session_start();
    
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

            if($result){
                $_SESSION["ID"] = $result['ID'];
                $_SESSION["EmployeeID"] = $result['EmployeeID'];
                header("Location: ./allDonations.php");
                exit;
            } else {
                $message = "Invalid username or password. Please try again.";
                echo "<script>alert('$message');</script>";
            }

            // if ($result) {
            //     // Credentials match, do something
            //     header("Location: ./allDonations.php");
            //     exit;
            // } else {
            //     // Credentials not found, do something else
            //     $message = "Invalid username or password. Please try again.";
            //     echo "<script>alert('$message');</script>";
            //     exit;
            // }
    
        } catch (PDOException $e){
            echo "Failed to query database: " . $e->getMessage();
        }


    }

?>