<?php
/*
    note:
    read steps in connectDB.php
*/
include 'connectDB.php';

try {
    // Donors preloaded data with Filipino names
    $donorEntries = [
        ["Juan dela Cruz", "123456789", "juan@example.com"],
        ["Maria dela Cruz", "987654321", "maria@example.com"],
        ["Jose Rizal", "456789123", "jose@example.com"],
        ["Maria Clara", "789123456", "mariaclara@example.com"],
        ["Andres Bonifacio", "321654987", "andres@example.com"],
        ["Teresa Magbanua", "654987321", "teresa@example.com"],
        ["Emilio Aguinaldo", "987321654", "emilio@example.com"],
        ["Gabriela Silang", "159753468", "gabriela@example.com"],
        ["Antonio Luna", "753159456", "antonio@example.com"],
        ["Gregoria de Jesus", "456123789", "gregoria@example.com"]
    ];

    // insert data into Donors table
    $insertDonor = "INSERT INTO Donors (DonorName, DonorNum, DonorEmail) VALUES (?, ?, ?)";
    $stmtDonor = $pdo_obj->prepare($insertDonor);
    foreach ($donorEntries as $donor) {
        $stmtDonor->execute($donor);
    }
    echo "Entries added to Donors table.";

    // Donations preloaded data
    $donationEntries = [
        ["Crayola Colored Pencils (24 Pack)", "Assorted colors for arts and crafts activities", 20, "Art Supplies", "2024-04-27", 1, "New in packaging"],
        ["LEGO Classic Bricks Set", "500 pieces for imaginative building and play", 15, "Toys", "2024-04-28", 2, "Unopened"],
        ["TI-84 Plus Graphing Calculator", "Advanced calculator for math and science classes", 10, "School Supplies", "2024-04-29", 3, "Like new"],
        ["Fisher-Price Play Kitchen Set", "Includes stove, oven, and play food accessories", 5, "Playtime", "2024-04-30", 4, "Lightly used"],
        ["Melissa & Doug Wooden Puzzle Set", "Assortment of puzzles for cognitive development", 12, "Educational Toys", "2024-05-01", 5, "Excellent condition"],
        ["Crayola Washable Markers (10 Pack)", "Non-toxic markers for drawing and coloring", 25, "Art Supplies", "2024-05-02", 6, "Unused"],
        ["Soccer Ball", "Official size and weight for outdoor play", 8, "Sports Equipment", "2024-05-03", 7, "Good condition"],
        ["Scientific Explorer Mind Blowing Science Kit", "STEM-based experiments for hands-on learning", 6, "Educational Toys", "2024-05-04", 8, "Complete set"],
        ["JanSport Superbreak Backpack", "Durable backpack for carrying books and supplies", 10, "School Supplies", "2024-05-05", 9, "Brand new"],
        ["Wooden Train Set", "Includes tracks, trains, and scenery pieces for imaginative play", 7, "Playtime", "2024-05-06", 10, "Lightly used"]
    ];

    // insert data into Donations table
    $insertDonation = "INSERT INTO Donations (ItemName, ItemDescription, ItemQty, ItemCategory, ItemDateRec, ItemDonorID, ItemRemarks) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtDonation = $pdo_obj->prepare($insertDonation);
    foreach ($donationEntries as $donation) {
        $stmtDonation->execute($donation);
    }
    echo "Entries added to Donations table.";

    $employeesEntries = [
        ["Miguel", "Santos", "Escandor","Worker","msescandor@mymail.mapua.edu.ph","Male","09279140221"],
        ["Vashti Leonie", "Dela Paz", "Bauson","Worker","vpdelapaz@mymail.mapua.edu.ph","Female",""],
        ["Althea Louise", "Cobangbang", "Cruz","Worker","alcruz@mymail.mapua.edu.ph","Female",""],
        ["Katrice Asher", "", "Albano","Worker","kagalbano@mymail.mapua.edu.ph","Female",""],
        ["Andre", "", "Aquino","Worker","aaaquino@mymail.mapua.edu.ph","Male",""]
    ];

    $insertEmployees = "INSERT INTO Employees (FirstName, MiddleName, LastName, Position, Email, Gender, ContactNumber) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtEmployees = $pdo_obj->prepare($insertEmployees);
    foreach ($employeesEntries as $employee) {
        $stmtEmployees->execute($employee);
    }
    echo "Entries added to Employees table.";

    $credentialsEntries = [
        [1, "msescandor", "test","2024-05-02"],
        [2, "vpdelapaz", "test","2024-05-02"],
        [3, "alcruz", "test","2024-05-02"],
        [4, "kagalbano", "test","2024-05-02"],
        [5, "aaaquino", "test","2024-05-02"],
    ];

    $insertCredentials = "INSERT INTO Credentials (EmployeeID, Username, Password, DateCreated) VALUES (?, ?, ?, ?)";
    $stmtCredentials = $pdo_obj->prepare($insertCredentials);
    foreach ($credentialsEntries as $credential) {
        $stmtCredentials->execute($credential);
    }
    echo "Entries added to Credentials table.";

    $categoryEntries = [
        ["Humanitarian Aid"],
        ["Health and Wellness"],
        ["Education and Literacy"],
        ["Child Welfare"],
        ["Volunteerism and Philanthropy"],
    ];

    $insertCategories = "INSERT INTO article_category (Category) VALUES (?)";
    $stmtCategories = $pdo_obj->prepare($insertCategories);
    foreach ($categoryEntries as $category) {
        $stmtCategories->execute($category);
    }
    echo "Entries added to Article Category table.";


} catch (PDOException $e) {
    echo "Failed to add entries: " . $e->getMessage();
}
?>
