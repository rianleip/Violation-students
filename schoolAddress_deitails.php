<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Add School Information";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <h3>Add School Information</h3>
        <form action="inc/helper/school_details.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control mt-3" name="school_name" placeholder="School Name" required>
                    <input type="text" class="form-control mt-3" name="school_city" placeholder="City" required>
                    <input type="text" class="form-control mt-3" name="school_address" placeholder="School Address" required>
                    <input type="email" class="form-control mt-3" name="school_email" placeholder="School Email" required>
                    <input type="file" class="form-control mt-3" accept=".png, .jpeg, .jpg" name="school_logo" placeholder="School Logo">
                </div>
                <div class="col-md-4">
                    <input type="tel" class="form-control mt-3" name="school_mobile_number" placeholder="School Mobile Number" required>
                    <input type="tel" class="form-control mt-3" name="school_tel_number" placeholder="School Telephone Number" required>
                    <input type="url" class="form-control mt-3" name="school_website" placeholder="School Website URL" required>
                </div>
            </div>     
            <button type="submit" class="btn btn-primary mt-3" name="add_address">Add</button>
        </form>
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
