<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set recipient email address
    $to = "vashti.delapaz@gmail.com";

    // Subject
    $subject = "New Inquiry";

    // Get the inquiry message from the form
    $message = $_POST["inquiry"];
    
    // Add sender's email for reply
    $headers = "From: " . $_POST["email"] . "\r\n";
    $headers .= "Reply-To: " . $_POST["email"] . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
