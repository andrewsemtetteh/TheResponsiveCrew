<?php
require 'common/header.php';

//fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// Check if the categories query failed
if (!$categories) {
    die("Categories query failed: " . mysqli_error($connection));
}
?>

<main class="container">
    <div class="blog-form-container">
        <h1>Create New Blog</h1>
        <?php if (isset($_SESSION['blog-error'])) : ?>
        <div class="alert_message error">
            <p><?= $_SESSION['blog-error']; 
                    unset($_SESSION['blog-error']); ?></p>
        </div>
        <?php endif ?>

        <form class="blog-form" action="<?= ROOT_URL ?>admin/createblogLogic.php" method="POST"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="title" />
            </div>

            <div class="form-group">
                <label for="blogCategory">Category</label>
                <select id="blogCategory" name="category_id">
                    <option value="">Select a category</option>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endwhile ?>
                </select>
            </div>

            <div class="form-group">
                <label for="blogSummary">Brief Summary</label>
                <textarea id="blogSummary" name="summary" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="blogContent">Blog Content</label>
                <textarea id="blogContent" name="content" rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="blogThumbnail">Add Thumbnail</label>
                <input type="file" id="blogThumbnail" name="thumbnail" accept="image/*" />
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn-primary">Publish Blog</button>
            </div>
        </form>
    </div>
</main>

<?php
require '../common/footer.php';
?>