<?php

require 'common/header.php';

// Fetch current user's posts from the database with prepared statement
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, media FROM posts WHERE author_id = ? ORDER BY id DESC"; 
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $current_user_id);
mysqli_stmt_execute($stmt);
$posts = mysqli_stmt_get_result($stmt);
?>
?>

<div class="manage-container container">
    <aside class="sidebar">
        <a href="<?= ROOT_URL ?>admin/createpost.php" class="sidebar-section">
            <i class="bx bx-plus-circle"></i>
            <h5>Add Spotlight</h5>
        </a>
        <a href="<?= ROOT_URL ?>admin/dashboard.php" class="sidebar-section active">
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
        <h2>Manage Spotlights</h2>
        <table class="category-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <!-- <th>Media</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                <tr>
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <!-- <td>
                        <?php 
                        $media = $post['media'];
                        $extension = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo "<img src='" . ROOT_URL . "uploads/" . $media . "' alt='Media' style='max-width: 100px; max-height: 100px;'>";
                        } else {
                            echo htmlspecialchars($media);
                        }
                        ?>
                    </td> -->
                    <td>
                        <button onclick="window.location.href='<?= ROOT_URL ?>admin/editPost.php?id=<?= $post['id'] ?>'"
                            class="btn-edit">Edit</button>
                        <button
                            onclick="window.location.href='<?= ROOT_URL ?>admin/deletePost.php?id=<?= $post['id'] ?>'"
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