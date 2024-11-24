<?php

require 'common/header.php';
?>

<main class="container">
    <section class="add-category-section">
        <h1>Edit Category</h1>
        <form id="add-category-form" action="" method="POST">
            <div class="form-group">
                <label for="category-title">Category Title</label>
                <input type="text" id="category-title" name="category-title" required />
            </div>
            <div class="form-group">
                <label for="category-description">Category Description</label>
                <textarea id="category-description" name="category-description" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Update Category</button>
        </form>
    </section>
</main>

<script src="/scripts/addCategory.js"></script>
</body>

</html>

<?php
  require '../common/footer.php';
?>