<?php
session_start();
$title = "Forgot Password";
$error = '';
$success = '';

// If the form was submitted
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
        // Here you should generate a password reset link and email it to the user
        // For now, we just simulate success
        $success = "A password reset link has been sent to your email.";
    } else {
        $error = "No user found with that email address.";
    }
}

require "template/header.php";
?>

<main>
    <section class="py-5 container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center mb-3">Forgot Password</h2>
                <form action="forgot_password.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Enter your email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <button type="submit" name="submit" class="btn btn-primary w-100 mt-4">Submit</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
require "template/footer.php";
?>
