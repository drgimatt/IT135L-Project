<?php
    include '../database/connectDB.php';

    $getArticles = "SELECT * FROM Articles WHERE AStatus = 'Published'";
    $articles = $pdo_obj->query($getArticles);
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
    <!--articles card start-->
    <div class="item-card-container" style="margin-bottom:20px">
        <?php
            if($articles->rowCount() > 0)
            {
                while($row = $articles->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<div class="item-card" style="padding:0">';
                    echo '<img class="item-card-pic" style="height:300px;min-width:300;" src="data:image/*;base64,' . $row['Picture'] . '">';
                    echo '<div class="item-card-body">';
                    echo '<h4 class="item-card-title">' .$row['Title'] . '</h4>';
                    echo '<img style="width:20px;margin:0;margin-right:5px" src="../assets/calendar-icon.png"';
                    echo '<p class="item-card-text">' .$row['DateCreated'] . '</p>';
                    echo '<div style="text-align: right;">'; // Aligning the button container to the right
                    echo '<a href="readNews.php?id='.$row['ID'].'" class="item-btn btn-teal">Read More</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }

            // if articles status published is empty
            else 
            {
                echo 'There are currently no published news.';
            }
        ?>
    </div>
    <!--articles card end-->

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