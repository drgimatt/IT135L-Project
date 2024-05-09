<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="icon" href="../assets/favicon.ico">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="./admin.css">
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
       
        <a class="btn btn-green ml-2" href="./adminLogoff.php">Logout</a>
    </nav>

<br>
<br>
<br>
<br>

<div class="container mt-5"  style="max-width: 1300px;">
    <h2 class="mb-1 green" style="font-weight:bold">Status Tracker</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="teal">Published</th>
                    <th class="green">Completed</th>
                    <th class="pink">In Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                include '../database/connectDB.php';

                // Count the number of articles with different statuses
                $stmt = $pdo_obj->query("SELECT 
                                            SUM(CASE WHEN AStatus = 'Published' THEN 1 ELSE 0 END) AS published_count,
                                            SUM(CASE WHEN AStatus = 'Completed' THEN 1 ELSE 0 END) AS completed_count,
                                            SUM(CASE WHEN AStatus = 'In progress' THEN 1 ELSE 0 END) AS in_progress_count
                                        FROM Articles");
                $counts = $stmt->fetch(PDO::FETCH_ASSOC);

                // Display the counts in the table body
                echo "<tr>";
                echo "<td>" . ($counts['published_count'] ?? '0') . "</td>";
                echo "<td>" . ($counts['completed_count'] ?? '0') . "</td>";
                echo "<td>" . ($counts['in_progress_count'] ?? '0') . "</td>";
                echo "</tr>";
                ?>
            </tbody>
        </table>

    </div>

    <br><br>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="mb-1 pink" style="font-weight:bold">Article Categories</h2>
        <a id="add-category-btn" class="btn btn-pink" href="#">Add Category</a>
    </div>
        <table id="category-table" class="table table-bordered mt-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include '../database/connectDB.php';

                    $stmt = $pdo_obj->query("SELECT * FROM Article_Category");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['ID']}</td>";
                        echo "<td>{$row['Category']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
        </table>
    
    <br><br>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="mb-1 teal" style="font-weight:bold">All Articles</h2>
        <a id="add-category-btn" class="btn btn-teal" href="addArticle.php">Create New Article</a>
    </div>
    <table id="articles-table" class="table table-bordered mt-1">
                <thead>
                    <tr>
                        <th>ArticleID</th>
                        <th>EmployeeID</th>
                        <th>CategoryID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include '../database/connectDB.php';

                    $stmt = $pdo_obj->query("SELECT * FROM Articles");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['ID']}</td>";
                        echo "<td>{$row['EmployeeID']}</td>";
                        echo "<td>{$row['CategoryID']}</td>";
                        echo "<td>{$row['Title']}</td>";
                        echo "<td>{$row['AStatus']}</td>";
                        echo "<td><a href='updateArticle.php?id={$row['ID']}'><button class='btn btn-ol-teal btn-sm'>Modify</button></a> <a href='deleteArticle.php?id={$row['ID']}'><button class='btn btn-ol-pink btn-sm'>Delete</button></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
        </table>
</div>

<br>
<br>
<br>
<br>
<br>
    <!-- Footer -->
    <footer class="bg-info text-center text-lg-start fixed-bottom" style="background-color: #DC35A1 !important; color: white;">
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy; Kids of Bataan
        </div>
        <!-- Copyright -->
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var addCategoryBtn = document.getElementById('add-category-btn');
            var categoryTableBody = document.querySelector('#category-table tbody');

            addCategoryBtn.addEventListener('click', function(event) {
                event.preventDefault(); 
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td></td>
                    <td contenteditable="true"></td>
                    <td><button class="btn btn-success save-btn">Save</button></td>
                `;
                categoryTableBody.appendChild(newRow);

                var rows = categoryTableBody.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
            });

            categoryTableBody.addEventListener('click', function(event) {
                if (event.target.classList.contains('save-btn')) {
                    var categoryCell = event.target.parentNode.previousElementSibling;
                    var category = categoryCell.textContent.trim();
                    if (category !== '') {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'addCategory.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                console.log('Category saved successfully');
                                event.target.style.display = 'none'; 
                            } else {
                                console.error('Error saving category');
                            }
                        };
                        xhr.send('category=' + encodeURIComponent(category));
                    } else {
                        alert('Category cannot be empty');
                    }
                }
            });
        });
    </script>

</body>
</html>