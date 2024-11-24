<?php

require 'common/header.php';
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
    </aside>

    <main class="main-content" id="manage-blogs">
        <h2>Manage Spotlights</h2>
        <table class="category-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>10 Essential Tips for Remote Work Success</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>The Impact of AI on Modern Business</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Building a Strong Personal Brand Online</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Sustainable Business Practices for 2024</td>
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

<?php
  require '../common/footer.php';
?>