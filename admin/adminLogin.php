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
        <a class="navbar-brand">
            <img src="../assets/logo-main.png" height="50px" alt="Your Logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       
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
                                <form id="loginForm">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
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

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Hardcoded credentials for verification
            var username = "admin";
            var password = "123";
            
            // Get entered username and password
            var enteredUsername = document.getElementById("username").value;
            var enteredPassword = document.getElementById("password").value;
            
            // Check if entered credentials match hardcoded credentials
            if (enteredUsername === username && enteredPassword === password) {
                // Redirect to the next page after successful login
                window.location.href = "./allDonations.php";
            } else {
                // Display an error message or handle invalid credentials
                alert("Invalid username or password. Please try again.");
            }
        });
    </script>

    </body>
</html>
