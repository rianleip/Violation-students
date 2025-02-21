<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Edit Student Information";
$student = selectWhere('students', 'student_id = ' . $_GET['student_id']);

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <h3>Edit Information for Student <?= $student->student_name ?> </h3>
        <form action="inc/helper/modify_student.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" class="form-control mt-3" name="student_id" value="<?= $student->student_id ?>" placeholder="Student ID" required>
                    <label for="student_name">Student Name</label>
                    <input type="text" class="form-control mt-3" id="student_name" name="student_name" value="<?= $student->student_name ?>" placeholder="Student Name" required>
                    <label for="student_father_name">Father's Name</label>
                    <input type="text" class="form-control mt-3" id="student_father_name" name="student_father_name" value="<?= $student->student_father_name ?>" placeholder="Parent's Name" required>
                    <label for="student_grade">Student Year</label>
                    <input type="text" class="form-control mt-3" id="student_grade" name="student_grade" value="<?= $student->student_grade ?>" placeholder="Student Year" required>
                    <label for="student_email">Email</label>
                    <input type="email" class="form-control mt-3" id="" name="student_email" value="<?= $student->student_email ?>" placeholder="Email" required>
                </div>
                <div class="col-md-4">
                    <label for="student_number">Phone Number</label>
                    <input type="number" class="form-control mt-3" id="student_number" name="student_number" value="<?= $student->student_number ?>" placeholder="Parent's Phone Number" required>
                    <label for="student_parent_number">Parent's Phone Number</label>
                    <input type="number" class="form-control mt-3" id="student_parent_number" name="student_parent_number" value="<?= $student->student_parent_number ?>" placeholder="Phone Number" required>
                    <label for="student_address">Address</label>
                    <input type="text" class="form-control mt-3" id="student_address" name="student_address" value="<?= $student->student_address ?>" placeholder="Address" required>
                </div>
                <div class="col-md-4 p-2">
                    <?php if ($student->student_image) : ?>
                        <img class="img-fluid" width="320" src="assets/images/<?= $student->student_image ?>" alt="<?= $student->student_image ?>" width="75px">
                    <?php else : ?>
                        <img class="img-fluid" width="320" src="assets/images/user.webp" width="75px">
                    <?php endif; ?>
                    <label for="student_image">Change Picture</label>
                    <input type="file" class="form-control" accept=".png, .jpeg, .jpg" id="student_image" name="student_image" placeholder="Student Image">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="modify_student">Save</button>
        </form>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
