<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');  // Ensuring user is authenticated
error403();  // Call if user does not have permission to access this page

// Page variables
$title = "Create Violation";

require "template/header.php";  // Header content
?>
<main>
    <section class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <form action="inc/helper/new_violation.php" method="POST">
                    <!-- Violation Text Input -->
                    <div class="mb-3">
                        <label for="violation_name" class="form-label">Violation Text</label>
                        <textarea class="form-control" id="violation_name" name="violation_name" placeholder="Violation Text" required></textarea>
                    </div>

                    <!-- Violation Level Select (1st Offense to 4th Offense) -->
                    <div class="mb-3">
                        <select class="form-select form-select-lg mb-3" name="violation_level" aria-label=".form-select-lg example" required>
                            <option selected disabled>Violation Level</option>
                            <option value="1">1st Offence</option>
                            <option value="2">2nd Offence</option>
                            <option value="3">3rd Offence</option>
                            <option value="4">4th Offence</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="create_violation">Create</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
require "template/footer.php";  // Footer content
?>
