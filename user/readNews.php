<?php
    // Include necessary files and initialize variables
    include '../database/connectDB.php';

    $employeeID = "";
    $title = "";
    $categoryID = "";
    $content = "";
    $picture = "";
    $date = "";
    $status = "";
    $authorFName = "";
    $authorLName = "";
    $categoryName = "";

    // color codes/legend array
    $categoryColors = array(
        "Announcement" => "#FCB020",
        "Advisory/Updates" => "#24B4C7",
        "Holiday" => "#7FCE46",
        "Events" => "#FF1F99",
        "Appreciation Post" => "#DC35A1",
    );

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // fetch article details from the database
        $getArticle = "SELECT * FROM Articles WHERE ID = :art_id";
        $stmt = $pdo_obj->prepare($getArticle);
        $stmt->bindParam(':art_id', $id);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if($article) {
            $employeeID = $article['EmployeeID'];
            $title = $article['Title'];
            $categoryID = $article['CategoryID'];
            $content = $article['Content'];
            $date = $article['DateCreated'];
            $status = $article['AStatus'];

            // get author's (employee) first and last name
            $getAuthorName = "SELECT FirstName, LastName FROM Employees WHERE ID = :author_id";
            $stmt = $pdo_obj->prepare($getAuthorName);
            $stmt->bindParam(':author_id', $employeeID);
            $stmt->execute();
            $author = $stmt->fetch(PDO::FETCH_ASSOC);
            if($author) {
                $authorFName = $author['FirstName'];
                $authorLName = $author['LastName'];
            }

            // get category name
            $getCategoryName = "SELECT Category FROM Article_Category WHERE ID = :category_id";
            $stmt = $pdo_obj->prepare($getCategoryName);
            $stmt->bindParam(':category_id', $categoryID);
            $stmt->execute();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            if($category) {
                $categoryName = $category['Category'];
            }
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
       
        <a class="btn btn-green ml-2"  href="../admin/signin.php">Login</a>
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
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="lead" style="font-size:110%">Published on <?php echo $date; ?> by <span><?php echo $authorFName . ' ' . $authorLName; ?></span></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <?php
                                        echo '<p style="font-size:smaller">Category:<span class="category-tab ml-2" style="font-size:smaller; background-color:' . ($categoryColors[$categoryName] ?? 'gray') . ';">' . $categoryName . '</span></p>';
                                    ?>
                                </div>
                            </div>
                            
                            <hr>
                            <br>
                            <p class="content-with-image justify-text"><?php echo $content; ?></p>
                        </div>
        <!--article end-->
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="newsPage.php" class="btn btn-pink">Back to All News</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

                </div>
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
    </footer>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
