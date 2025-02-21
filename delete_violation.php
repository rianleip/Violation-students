<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Delete Violation";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <h3>Delete Violation</h3>
                <span class="text-muted">When a violation is deleted from the system, all related violations will also be removed.</span>
            </div>
        </div>
        <p class="text-danger mb-3">Only the system administrator can remove the violation from the system.</p>
        <?php if (is_admin($_SESSION['user_email'])) : ?>
            <p>
                Dear admin, you can delete violations from the code of conduct list 
                <a href="violations.php">here</a>
            </p>
        <?php endif ?>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
