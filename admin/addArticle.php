<?php
    session_start();
    $statusMessage = "";

    // include database files
    include '../database/connectDB.php';

    // initialize variables
    $employeeID = $_SESSION["EmployeeID"];
    $title = "";
    $categoryID = "";
    $content = "";
    $picture = "";
    $date = "";
    $status = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $categoryID = $_POST["categoryID"];
        $content = $_POST["content"];
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
        $image_encoded = base64_encode($picture);
        $date = $_POST["date"];
        $status = $_POST["status"];

        // Prepare the SQL statement with placeholders
        $insertArticle = "INSERT INTO Articles (EmployeeID, Title, CategoryID, Content, Picture, DateCreated, AStatus) 
                        VALUES (:employeeID, :title, :categoryID, :content, :picture, :date, :status)";

        // Prepare the statement
        $stmt = $pdo_obj->prepare($insertArticle);

        // Bind parameters
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':picture', $image_encoded);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);

        try {
            // Execute the statement
            $stmt->execute();

            echo "
                <script>
                alert('Article Created');
                document.location.href = 'articleDashboard.php';
                </script>
            ";
        } catch (PDOException $e) {
            echo "
                <script>
                alert('Failed to create article. Error: ".$e->getMessage()."');
                document.location.href = 'addArticle.php';
                </script>
            ";
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="./allDonors.php">Donors</a>
                </li>
                <li class="nav-item active">
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
            <h2 class="teal text-center mb-1" style="font-weight:bold">Add Article</h2>
            <div class="card shadow" style="width: 100%">
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="employeeID">Your Employee ID</label>
                            <input type="number" class="form-control" id="employeeID" name="employeeID" disabled placeholder="<?php echo $_SESSION["EmployeeID"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                        <label for="categoryID">Category</label>
                            <select class="form-control" id="categoryID" name="categoryID" required>
                                <?php
                                include '../database/connectDB.php';

                                $sql = "SELECT * FROM Article_Category";
                                $stmt = $pdo_obj->query($sql);

                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $CID = $row['ID'];
                                    $CNAME = $row['Category'];
                                    echo "<option value='$CID'>$CNAME</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Content/Body</label>
                            <textarea type="text" class="form-control" id="content" name="content" style="height:500px" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="picture">Cover Image</label>
                            <input type="file" id="picture" name="picture" class="form-control" onchange="onFileSelected(event)" accept="image/*">
                            <!--placeholder-->
                            <br>
                            <div class="center">
                                <img id="myimage"  class="form-control image-container" style="display:block; margin-left:auto; margin-right:auto; height: 200px; width: 500px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date">Date Written</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Published">Published</option>
                            </select>
                        </div>

                        <!-- submit the form -->
                        <div class="submitbutton text-center">
                            <button type="submit" class="btn btn-pink" style="width: 200px; margin-bottom: 20px;">Create Article</button>
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
        window.location.href = "./allDonations.php";
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

    <script>
        function onFileSelected(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("myimage");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
            document.getElementById('myimage').style.display = ""
        }
    </script>
</body>
</html>