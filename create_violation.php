<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Report Violation";
$violation_levels = [
    ['level_number' => 1, 'level_name' => '1st Offence'],
    ['level_number' => 2, 'level_name' => '2nd Offence'],
    ['level_number' => 3, 'level_name' => '3rd Offence'],
    ['level_number' => 4, 'level_name' => '4th Offence'],
];

$violations = false;

if (isset($_GET['vid'])) {
    $violations = selectWhere('violations', 'violation_level_number = ' . $_GET['vid'], true);
}

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <h3>Report Violation</h3>
            </div>
        </div>
        <form action="inc/helper/create_violation.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <label class="mt-3" for="violation_level">Violation Level</label>
                    <select class="form-select mt-1" id="violation_level" name="violation_level" onchange="location = 'create_violation.php?vid=' + this.value;" required>
                        <option value="" selected disabled>Violation Level</option>
                        <?php foreach ($violation_levels as $violation_level) : ?>
                            <option value="<?= $violation_level['level_number'] ?>" <?php if (isset($_GET['vid'])) : ?> <?= $violation_level['level_number'] == $_GET['vid'] ? 'selected' : '' ?> <?php endif; ?>>
                                <?= $violation_level['level_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="ui-widget">
                        <label class="mt-3" for="student_name">Student Name (Students)</label>
                        <input type="text" id="student_name" class="form-control mt-3" placeholder="Student Name" autocomplete="off" required>
                        <input type="hidden" id="student_id" name="student_id">
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($violations) : ?>
                        <label class="text-dark mb-3">Violation List</label>
                        <?php foreach ($violations as $violation) : ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="violation_id" id="violation_<?= $violation[0] ?>" value="<?= $violation[0] ?>" onchange="enableBtn()" required>
                                <label class="form-check-label" for="violation_<?= $violation[0] ?>">
                                    <?= $violation[1] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="text-muted">No violations have been created for this level yet.</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="mt-3">
                        <label for="note" class="form-label">Notes</label>
                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Notes (optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="id">Upload PDF File (Optional)</label>
                    <input type="file" class="form-control my-3" name="pdf_file" id="pdf" accept="application/pdf" placeholder="PDF">
                    <input class="form-check-input" type="checkbox" name="send_email" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Send to Parent
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="create_violation" disabled="">Confirm</button>
        </form>
    </section>
</main>
<?php if (isset($_GET['success'])) : ?>
    <script>
        Swal.fire('Violation Reported Successfully')
    </script>
<?php endif; ?>
<?php if (isset($_GET['error'])) : ?>
    <script>
        Swal.fire('An error occurred')
    </script>
<?php endif; ?>

<script>
    let btn = document.getElementsByName('create_violation');

    function enableBtn() {
        if (document.querySelector('input[name="violation_id"]:checked').value != '') {
            btn[0].disabled = false
        }
    }
</script>

<!-- jQuery Libraries for direct querying from the database -->
<link rel="stylesheet" href="assets/css/jquery-ui.css">
<script src="assets/js/jquery-3.6.0.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
    var student_ids = [];

    $(function() {
        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#student_name")
            .on("keydown", function(event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                source: function(request, response) {
                    $.getJSON("inc/helper/search.php", {
                        term: extractLast(request.term)
                    }, response);
                },
                search: function() {
                    var term = extractLast(this.value);
                    if (term.length < 2) {
                        return false;
                    }
                },
                focus: function() {
                    return false;
                },
                select: function(event, ui) {
                    var terms = split(this.value);
                    student_ids.push(ui.item.id);
                    terms.pop();
                    terms.push(ui.item.value);
                    terms.push("");
                    this.value = terms.join(", ");
                    $('#student_id').val(JSON.stringify(student_ids)); // store array
                    return false;
                }
            });
    });
</script>

<?php
require "template/footer.php"; // Footer content
?>
