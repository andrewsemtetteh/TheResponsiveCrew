<?php

require 'common/header.php';
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

        <a href="<?= ROOT_URL ?>admin/addUser.php" class="sidebar-section">
            <i class="bx bx-user-plus"></i>
            <h5>Add User</h5>
        </a>
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
                <tr>
                    <td>The Future of Web Development</td>
                    <td>Technology</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>UI/UX Design Trends 2024</td>
                    <td>Design</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Digital Marketing Strategies</td>
                    <td>Marketing</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Investment Tips for Beginners</td>
                    <td>Finance</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</div>

</body>

</html>

<?php
  require '../common/footer.php';
?>