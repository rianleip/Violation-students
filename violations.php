<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

$violations = select('violations');

// Page variables
$title = "Violation List";
$i = 0; // For table row numbering

require "template/header.php"; // Header content

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <a href="addviolation.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Add New Violation to the System
                </a>
            </div>
        </div>
        <?php if ($violations) : ?>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Violation</th>
                        <th>Violation Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($violations as $violation) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $violation['violation_name'] ?></td>
                            <td><?= $violation['violation_level_number'] ?></td>
                            <td>
                                <button class="btn btn-sm" onclick="del(<?= $violation['id'] ?>)">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                                <button class="btn btn-sm" onclick="edit(<?= $violation['id'] ?>)">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <input type="checkbox" value="<?= $violation['id'] ?>" onchange="check()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <form action="inc/helper/remove_violation.php?multi_delete" method="POST">
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
<?php if (isset($_GET['del_success'])) : ?>
    <script>
        Swal.fire('Violation deleted successfully')
    </script>
<?php endif; ?>
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
                location.href = 'inc/helper/remove_violation.php?confirm_delete&id=' + id;
            }
        })
    }

    function edit(id) {
        location.href = 'editviolation.php?id=' + id;
    }
</script>

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
</script>

<?php
require "template/footer.php"; // Footer content
?>
