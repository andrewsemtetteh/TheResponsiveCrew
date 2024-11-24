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
        <a href="<?= ROOT_URL ?>admin/manageblog.php" class="sidebar-section">
            <i class="bx bx-edit"></i>
            <h5>Manage Blog</h5>
        </a>
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
                <tr>
                    <td>Andrew Sem Tetteh</td>
                    <td>andrew.tetteh@ashesi.edu.gh</td>
                    <td>Yes</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Griselda Owusu-Ansah</td>
                    <td>griselda.ansah@ashesi.edu.gh</td>
                    <td>No</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Princess Cheryl</td>
                    <td>princess.cheryl@ashesi.edu.gh</td>
                    <td>No</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>James Kantamantu-Koomson</td>
                    <td>james.koomson@ashesi.edu.gh</td>
                    <td>Yes</td>
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