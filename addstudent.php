<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Create Student";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <h3>Add New Student</h3>
        <form action="inc/helper/add_students.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="number" class="form-control mt-3" name="student_id" placeholder="Student ID" required>
                    <input type="text" class="form-control mt-3" name="student_name" placeholder="Student Name" required>
                    <input type="text" class="form-control mt-3" name="student_father_name" placeholder="Parent's Name" required>
                    <input type="text" class="form-control mt-3" name="student_grade" placeholder="Student Year" required>
                    <input type="file" class="form-control mt-3" accept=".png, jpeg, .jpg" name="student_image" placeholder="Student Image">
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control mt-3" name="student_birth" placeholder="Date of Birth" required>
                    <input type="email" class="form-control mt-3" name="student_email" placeholder="Email" required>
                    <input type="number" class="form-control mt-3" name="student_number" placeholder="Parent's Phone Number" required>
                    <input type="number" class="form-control mt-3" name="student_parent_number" placeholder="Phone Number" required>
                    <input type="text" class="form-control mt-3" name="student_address" placeholder="Address" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="create_student">Add</button>
        </form>
        <hr>
        <div class="row">
            <div class="col-md">
                <h3>Upload CSV File</h3>
                <small class="text-muted">
                    The file format should be as follows:
                    <br>
                    `student_id`, `student_name`, `student_father_name`, `student_grade`, `student_image`, `student_birth`, `student_email`, `student_number`, `student_parent_number`, `student_address`
                </small>
                <small class="text-muted">Note: The CSV file encoding must be UTF-8 for Arabic text.</small>
                <br>
                <a href="assets/csv_example.csv" download>Download CSV Template</a>
                <form class="mt-3 w-25" method="POST" action="inc/helper/add_students.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" accept=".csv" required>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="SubmitCSV" class="btn btn-primary">
                            Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
