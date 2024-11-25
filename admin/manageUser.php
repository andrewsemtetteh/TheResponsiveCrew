<?php
require 'common/header.php';

// Fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE id != $current_admin_id";
$users = mysqli_query($connection, $query);

// Check if query was successful
if (!$users) {
    die("Query failed: " . mysqli_error($connection));
}
?>


<div class="manage-container container">
    <aside class="sidebar">
        <a href="<?= ROOT_URL ?>admin/createpost.php" class="sidebar-section">
            <i class="bx bx-plus-circle"></i>
            <h5>Add Spotlight</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/dashboard.php" class="sidebar-section">
            <i class="bx bx-edit"></i>
            <h5>Manage Spotlight</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/createblog.php" class="sidebar-section">
            <i class="bx bx-plus-circle"></i>
            <h5>Add Blog</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/manageblog.php" class="sidebar-section">
            <i class="bx bx-edit"></i>
            <h5>Manage Blog</h5>
        </a>

        <?php if (isset($_SESSION['user_is_admin'])): ?>
        <a href="<?= ROOT_URL ?>admin/addUser.php" class="sidebar-section">
            <i class="bx bx-user-plus"></i>
            <h5>Add User</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/manageUser.php" class="sidebar-section active">
            <i class="bx bx-user-check"></i>
            <h5>Manage User</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/addCategory.php" class="sidebar-section">
            <i class="bx bx-plus-circle"></i>
            <h5>Add Category</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/manageCategory.php" class="sidebar-section">
            <i class="bx bx-category"></i>
            <h5>Manage Category</h5>
        </a>
        <?php endif; ?>
    </aside>

    <main class="main-content" id="manage-users">
        <h2>Manage Users</h2>
        <table class="category-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = mysqli_fetch_assoc($users)) : ?>
                <tr>
                    <td><?= isset($user['fullname']) ? htmlspecialchars($user['fullname']) : 'N/A' ?></td>
                    <td><?= isset($user['email']) ? htmlspecialchars($user['email']) : 'N/A' ?></td>
                    <td><?= isset($user['is_admin']) && $user['is_admin'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <button onclick="window.location.href='<?= ROOT_URL ?>admin/editUser.php?id=<?= $user['id'] ?>'"
                            class="btn-edit">Edit</button>
                        <button
                            onclick="window.location.href='<?= ROOT_URL ?>admin/deleteUser.php?id=<?= $user['id'] ?>'"
                            class="btn-delete">Delete</button>
                    </td>

                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>
</div>

</body>

</html>

<?php
require '../common/footer.php';
?>