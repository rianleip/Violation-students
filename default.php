<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// Page variables
$title = "Default Page";

require "template/header.php"; // Header content
?>
<main>
    <section class="container py-5">
        <!-- Content Goes Here -->
    </section>
</main>
<?php
require "template/footer.php"; // Footer content
?>
