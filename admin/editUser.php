<?php

require 'common/header.php';
?>

<main class="container">
    <section class="create-post-section">
        <h1>Edit User</h1>
        <form id="create-post-form" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post-title">Full Name</label>
                <input type="text" id="fullname" required />
            </div>
            <div class="form-group">
                <label for="userCategory">User Type</label>
                <select id="userCategory" name="userCategory" required>
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Update User</button>
        </form>
    </section>
</main>

</body>

</html>

<?php
  require '../common/footer.php';
?>