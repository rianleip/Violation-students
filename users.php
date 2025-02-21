<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

$users = select('users');
// Page variables
$title = "User List";

require "template/header.php"; // Header content

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <a href="adduser.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Add New User
                </a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['full_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['is_admin']  ? 'Admin' : 'User' ?></td>
                        <td class="w-25">
                            <form action="inc/helper/make_admin.php" method="get">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <select name="user_type">
                                    <option value="">Select</option>
                                    <option value="0">Regular User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <button class="btn btn-sm btn-primary" type="submit" name="make_admin">Confirm</button>
                            </form>
                            <span>
                                <button class="btn" onclick="del(<?= $user['id'] ?>)">
                                    <i class="bi bi-trash text-danger"></i>
                                    Delete User
                                </button>
                            </span>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>

<script>
    function del(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = 'inc/helper/remove_user.php?confirm_delete&id=' + id;
            }
        })
    }
</script>

<?php
require "template/footer.php"; // Footer content
?>
