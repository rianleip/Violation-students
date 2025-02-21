<?php
session_start();
$title = "Create Account";
$error = '';
$success = '';

// Include the Composer autoload file to load PHPMailer
require 'vendor/autoload.php';  // Include PHPMailer library

// If the form was submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if the email already exists in the database
        require "inc/functions.php";
        $conn = databaseConnect();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "This email is already registered.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $insert_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ss", $email, $hashed_password);
            if ($insert_stmt->execute()) {
                // Send a confirmation email using PHPMailer
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
                    $mail->setFrom('your-email@gmail.com', 'Your Name');
                    $mail->addAddress($email); // Add the recipient's email address

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Account Creation Confirmation';
                    $mail->Body    = 'Thank you for creating an account. Click <a href="https://yourdomain.com/verify_account.php?email=' . urlencode($email) . '">here</a> to verify your account.';

                    // Send email
                    $mail->send();
                    $success = 'Account created successfully! A confirmation email has been sent to your email address.';
                } catch (Exception $e) {
                    $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $error = "Failed to create account.";
            }
        }
    }
}

require "template/header.php"; // Header content
?>

<main>
    <section class="py-5 container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center mb-3">Create Account</h2>
                <form action="create_account.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <button type="submit" name="submit" class="btn btn-primary w-100 mt-4">Create Account</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="login.php" class="text-decoration-none">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require "template/footer.php"; // Footer content
?>
