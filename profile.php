<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    require "inc/functions.php";
    $conn = databaseConnect();
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, send password reset email using PHPMailer

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@gmail.com'; // Your Gmail address
            $mail->Password = 'your-app-password'; // Your Gmail App password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('your-email@gmail.com', 'Your Name'); // Sender's email
            $mail->addAddress($email); // Add the recipient's email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = 'Click <a href="https://yourdomain.com/reset_password.php?email=' . urlencode($email) . '">here</a> to reset your password.';

            // Enable SMTP debugging (helps diagnose issues)
            $mail->SMTPDebug = 2;  // Debug level: 2 for detailed debugging

            // Send email
            $mail->send();
            echo 'Password reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No user found with that email address.";
    }
}
?>
