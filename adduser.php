<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

// Page variables
$title = "Default Page";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <form action="inc/helper/new_user.php" method="POST">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="school_email" class="form-label">School Email</label>
                        <input type="email" class="form-control" id="school_email" name="school_email" placeholder="School Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="make_admin" name="make_admin">
                        <label class="form-check-label" for="make_admin">Grant Admin Rights</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_user">Create</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
