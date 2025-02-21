<?php
session_start();
require "inc/functions.php";

// Get the email from the query parameter
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Verify the email in the database
    $conn = databaseConnect();
    $sql = "UPDATE users SET email_verified = 1 WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        echo "Your email has been verified successfully!";
    } else {
        echo "There was an error verifying your email.";
    }
} else {
    echo "Invalid request!";
}
?>
