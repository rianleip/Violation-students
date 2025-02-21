<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

if (!empty($_GET['student_id'])) {
    $student_violations = getStudentViolations($_GET['student_id']);
} else {
    $student_violations = getStudentsViolations();
}

// Page variables
$title = "Violation List";

require "template/header.php"; // Header content

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-2">
                <a href="create_violation.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Report Violation
                </a>
            </div>
            <div class="col-md">
                <form action="student_violations.php" method="GET">
                    <label for="student_id">Search for Student Violations</label>
                    <input type="number" name="student_id" id="student_id" placeholder="Enter student ID">
                    <button type="submit" name="search" class="btn btn-primary ms-2">
                        <i class="bi bi-plus"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>
        <?php if ($student_violations) : ?>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Violation Level</th>
                        <th class="w-25">Violation</th>
                        <th>Notes</th>
                        <th>PDF</th>
                        <th>Violation Date</th>
                        <th>
                            Edit
                            <a href="#" class="btn btn-sm d-inline" onclick="selectAll()" title="Select All"><i class="bi bi-check2-all"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student_violations as $student_violation) : ?>
                        <tr>
                            <td><?= $student_violation[0] ?></td>
                            <td><?= $student_violation[7] ?></td>
                            <td><?= $student_violation[8] ?></td>
                            <td><?= $student_violation[19] ?></td>
                            <td><?= $student_violation[18] ?></td>
                            <td><?= $student_violation[3] ? $student_violation[3] : '' ?></td>
                            <td class="text-center">
                                <?php if (!empty($student_violation[4])) : ?>
                                    <a href="assets/pdf/<?= $student_violation[4] ?>" download>
                                        <i class="bi bi-filetype-pdf fs-5"></i>
                                    </a>
                                <?php else : ?>
                                    None
                                <?php endif ?>
                            </td>
                            <td><?= $student_violation[5] ?></td>
                            <td>
                                <span>
                                    <button class="btn" onclick="del(<?= $student_violation[0] ?>)">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </span>
                                <input type="checkbox" value="<?= $student_violation[0] ?>" onchange="check()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <form action="inc/helper/remove_student_violation.php?multi_delete" method="POST">
                <input type="hidden" id="checked" name="checked">
                <button type="submit" class="btn btn-danger float-end">Delete Selected</button>
            </form>
        <?php else : ?>
            <div class="row text-center">
                <span class="text-dark"> No violations have been added yet </span>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    function del(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You cannot undo this action",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = 'inc/helper/remove_student_violation.php?confirm_delete&id=' + id;
            }
        })
    }
</script>
<?php if (isset($_GET['del_success'])) : ?>
    <script>
        Swal.fire('Violation deleted successfully')
    </script>
<?php endif; ?>

<script>
    function check() {
        var array = []
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
            array.push(parseInt(checkboxes[i].value))
        }

        document.getElementById('checked').value = array
        console.log(array)
        console.log(document.getElementById('checked').value)
    }

    function selectAll() {
        var allchecked = document.querySelectorAll('input[type=checkbox]:checked')
        var checkboxes = document.querySelectorAll('input[type=checkbox]')

        if (allchecked.length == checkboxes.length) {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = true;
            }
        }

        check();
    }
</script>

<?php
require "template/footer.php"; // Footer content
?>
