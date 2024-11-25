<?php

require 'common/header.php';
?>

<main class="container">
    <section class="create-post-section">
        <h1>Add User</h1>
        <form id="create-post-form" action="<?= ROOT_URL ?>addUserLogic.php" enctype="multipart/form-data"
            method="POST">
            <div class="form-group">
                <label for="post-title">Full Name</label>
                <input type="text" id="fullname" required />
            </div>
            <div class="form-group">
                <label for="post-title">Ashesi Email</label>
                <input type="email" id="email" required />
            </div>
            <div class="form-group">
                <label for="post-title">Password</label>
                <input type="password" id="password" required />
            </div>
            <div class="form-group">
                <label for="post-title">Confirm Password</label>
                <input type="password" id="passwordConfirm" required />
            </div>
            <div class="form-group">
                <label for="userCategory">User Type</label>
                <select id="userCategory" name="userCategory" required>
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="post-media">Upload Profile</label>
                <div class="media-upload-container">
                    <input type="file" id="post-media" required />
                    <div class="media-preview">
                        <img src="#" alt="Media Preview" id="media-preview" />
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn">Add User</button>
        </form>
    </section>
</main>

</body>

</html>

<?php
  require '../common/footer.php';
?>