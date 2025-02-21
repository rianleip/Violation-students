<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Logout from the system
if (isset($_GET['logout'])) logout();

// Page variables
$title = "Home";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="section-title mb-5">
                    Main Menu
                </h2>
            </div>
            <!-- topic-item -->
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="create_violation.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        Report Violation
                    </h3>
                    <button class="btn btn-primary mt-3">
                        Report Violation
                    </button>
                </a>
            </div>
            
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="student_violations.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        View All Violations
                    </h3>
                    <button class="btn btn-primary mt-3">
                        View All Violations
                    </button>
                </a>
            </div>
           
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="addstudent.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        Add Student
                    </h3>
                    <button class="btn btn-primary mt-3">
                        Add Student
                    </button>
                </a>
            </div>
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="students.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        View Students
                    </h3>
                    <button class="btn btn-primary mt-3">
                        View Students
                    </button>
                </a>
            </div>

            <?php if (is_admin($_SESSION['user_email'])) : ?>
                <div class="col-lg-5 col-sm-6 mb-5">
                    <a href="users.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                        <h3 class="mb-3 mt-0">
                            Users
                        </h3>
                        <button class="btn btn-primary mt-3">
                            Users
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-sm-6 mb-5">
                    <a href="violations.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                        <h3 class="mb-3 mt-0">
                            Code of Conduct
                        </h3>
                        <button class="btn btn-primary mt-3">
                            Code of Conduct
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-sm-6 mb-5">
                    <a href="schoolAddress_details.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                        <h3 class="mb-3 mt-0">
                            Add School Information
                        </h3>
                        <button class="btn btn-primary mt-3">
                            Add School Information
                        </button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
