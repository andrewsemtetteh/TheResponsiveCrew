<?php
require 'common/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    // Populate variables to avoid undefined variable warning
    $fullname = $user['fullname'];
    $is_admin = $user['is_admin'];
} else { 
    header('location: ' . ROOT_URL .'admin/manageUser.php');
    die();
}
?>

<main class="container">
    <section class="create-post-section">
        <h1>Edit User</h1>
        <form id="create-post-form" action="<?= ROOT_URL?>admin/editUserLogic.php" method="POST">
            <div class="form-group">
                <label for="post-title">Full Name</label>
                <input type="hidden" name="id" id="id" value="<?= $id ?>" required />
                <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($fullname) ?>" required />
            </div>
            <div class="form-group">
                <label for="userrole">User Type</label>
                <select id="userrole" name="userrole" required>
                    <option value="0" <?= $is_admin == 0 ? 'selected' : '' ?>>Author</option>
                    <option value="1" <?= $is_admin == 1 ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" name="submit" class="submit-btn">Update User</button>
        </form>
    </section>
</main>

<?php
require '../common/footer.php';
?>