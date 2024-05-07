<?php
include '../database/connectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category"])) {
    $category = $_POST["category"];

    $stmt = $pdo_obj->prepare("INSERT INTO Article_Category (Category) VALUES (?)");
    $stmt->execute([$category]);
}
?>
