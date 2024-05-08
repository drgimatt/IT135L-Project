<?php

    include '../database/connectDB.php';

    $employeeID = "";
    $title = "";
    $categoryID = "";
    $content = "";
    $picture = "";
    $date = "";
    $status = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $getArticle = "SELECT * FROM Articles WHERE ID = :art_id";
        $stmt = $pdo_obj->prepare($getArticle);
        $stmt->bindParam(':art_id', $id);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if($article)
        {
            $employeeID = $article['EmployeeID'];
            $title = $article['Title'];
            $categoryID = $article['CategoryID'];
            $content = $article['Content'];
            $date = $article['DateCreated'];
            $status = $article['AStatus'];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids of Bataan</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="news.css">
    <link rel="icon" href="../assets/favicon.ico">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <!-- Import Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- pls DO NOT delete. not working properly when placed only in the css file -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

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
                    <a class="nav-link" href="aboutus.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="newsPage.php">Newspage</a>
                </li>
            </ul>
        </div>
       
        <a class="btn btn-green ml-2"  href="../admin/adminLogin.php">Login</a>
    </nav>
        <br><br>

    <!--article start-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron-fluid">
                    <div class="container">
                        <?php
                            echo '<img class="img-fluid rounded-start" src="data:image/' . pathinfo($article['Picture'], PATHINFO_EXTENSION) . ';base64,' . $article['Picture'] . '" id="art_image">';
                        ?>
                        <h1 class="display-4 mt-3" style="font-weight:bold"><?php echo $title; ?></h1>
                        <p class="lead">Published on <?php echo $date; ?> by <span><?php echo $authorName; ?></span>, Category: <span><?php echo $categoryName; ?></span></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Content -->
                <p><?php echo $content; ?></p>
            </div>
        </div>
    </div>
    <!--article end-->

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <a href="newsPage.php" class="btn btn-pink">Back to All News</a>
            </div>
        </div>
    </div>

    <br><br><br><br>

    <!-- Footer -->
    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #7FCE46 !important; color: white;">
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