<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="contact.css">
    <link rel="icon" href="../assets/favicon.ico">

</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand"><img src="../assets/logomain.png" height="40px" alt="Your Logo"></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="newsPage.php">Newspage</a>
                </li>
            </ul>
        </div>
       
        <a class="btn btn-teal ml-2"  href="../admin/adminLogin.php">Login</a>
    </nav>
    <!-- Contact Information Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-left mb-1 contact-heading" style="color: #DC35A1"><strong>Let's</strong></h2>
                <h2 class="text-left mt-1 mb-4 contact-heading" style="color: #24B4C7"><strong>Connect!</strong></h2>
                <div class="contact-info">
                    <p><strong>Founder - Laurence Macabenta</strong></p>
                    <p><em>thatkidlau@gmail.com | 09165068388</em></p>
                    <p><strong>Email</strong></p>
                    <p><em>kidsofbataan&#64;gmail.com</em></p>
                    <p><strong>Facebook</strong></p>
                    <p><em>Kids of Bataan</em></p>
                    <p><strong>Instagram</strong></p>
                    <p><em>&#64;kidsofbataan</em></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="inquiry-area">
                    <form id="inquiryForm" action="send.php" method="post">
                        <h3 style="color: #24B4C7">Inquiries</h3>
                        <input type="email" name="email" placeholder="Your email">
                        <input class="mt-2 "type="text" name="subject" placeholder="Subject">
                        <textarea name="message" placeholder="Write your inquiry here"></textarea>
                        <button type="submit" name="send" class="btn btn-primary mt-3 custom-button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #DC35A1  !important; color: white;">
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy; Kids of Bataan
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
   
   
</body>
</html>
