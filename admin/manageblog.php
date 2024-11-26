<?php
require 'common/header.php';

// Fetch current user's posts from the database with prepared statement
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM blogs WHERE author_id = ? ORDER BY id DESC"; 
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $current_user_id);
mysqli_stmt_execute($stmt);
$blogs = mysqli_stmt_get_result($stmt);
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
        <a href="<?= ROOT_URL ?>admin/manageblog.php" class="sidebar-section active">
            <i class="bx bx-edit"></i>
            <h5>Manage Blog</h5>
        </a>

        <?php if (isset($_SESSION['user_is_admin'])): ?>

        <a href="<?= ROOT_URL ?>admin/manageUser.php" class="sidebar-section">
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

    <main class="main-content" id="manage-posts">
        <h2>Manage Blogs</h2>
        <table class="category-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($blog = mysqli_fetch_assoc($blogs)) : ?>
                <?php
                    // Use prepared statement for category query
                    $category_id = $blog['category_id'];
                    $category_query = "SELECT title FROM categories WHERE id = ?"; 
                    $category_stmt = mysqli_prepare($connection, $category_query);
                    mysqli_stmt_bind_param($category_stmt, "i", $category_id);
                    mysqli_stmt_execute($category_stmt);
                    $category_result = mysqli_stmt_get_result($category_stmt);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                <tr>
                    <td><?= htmlspecialchars($blog['title']) ?></td>
                    <td><?= htmlspecialchars($category['title']) ?></td>
                    <td>
                        <button onclick="window.location.href='<?= ROOT_URL ?>admin/editBlog.php?id=<?= $blog['id'] ?>'"
                            class="btn-edit">Edit</button>
                        <button
                            onclick="window.location.href='<?= ROOT_URL ?>admin/deleteBlog.php?id=<?= $blog['id'] ?>'"
                            class="btn-delete">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>

<?php
require '../common/footer.php';
?>