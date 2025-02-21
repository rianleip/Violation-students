<?php
/**
 * If the user is logged in and tries to access this page again,
 * they will be redirected to the homepage.
 */
session_start();
if (isset($_SESSION['user_authenticated'])) {
    header("Location: index.php");
    exit();
}

// Page variables
$title = "Login";
$error = isset($_GET['error']) ? "Incorrect username or password" : false; // Condition for error message

require "template/header.php"; // Header content
?>
<main>
    <section class="py-5 container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center mb-3">Login</h2>
                <form action="inc/helper/login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <span class="text-danger"><b><?= $error ?></b></span>
                    <button type="submit" name="login" class="btn btn-primary w-100 mt-4">Login</button>
                </form>
                
                <!-- Forgot password link -->
                <div class="mt-3 text-center">
                    <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                </div>
                
                <!-- Create account link -->
                <div class="mt-3 text-center">
                    <a href="create_account.php" class="text-decoration-none">Create an Account</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
