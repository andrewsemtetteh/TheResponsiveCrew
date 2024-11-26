<?php
require 'common/header.php';

// Fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

if (!$categories) {
    die("Categories query failed: " . mysqli_error($connection));
}

// Validate and fetch blog post to edit
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if (!$id) {
        $_SESSION['error-message'] = "Invalid blog ID.";
        header('Location: ' . ROOT_URL . 'admin/manageblog.php');
        exit();
    }
    
    // Fetch the current blog details using prepared statement
    $query = "SELECT * FROM blogs WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $blog = mysqli_fetch_assoc($result);
    
    if (!$blog) {
        $_SESSION['error-message'] = "Blog post not found.";
        header('Location: ' . ROOT_URL . 'admin/manageblog.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "No blog ID provided.";
    header('Location: ' . ROOT_URL . 'admin/manageblog.php');
    exit();
}
?>

<main class="container">
    <div class="blog-form-container">
        <h1>Edit Blog</h1>
        <?php if (isset($_SESSION['blog-error'])) : ?>
        <div class="alert_message error">
            <p><?= $_SESSION['blog-error']; 
                    unset($_SESSION['blog-error']); ?></p>
        </div>
        <?php endif ?>

        <form class="blog-form" action="<?= ROOT_URL ?>admin/editBlogLogic.php" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">

            <div class="form-group">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="title" value="<?= htmlspecialchars($blog['title']) ?>"
                    required />
            </div>

            <div class="form-group">
                <label for="blogCategory">Category</label>
                <select id="blogCategory" name="category_id" required>
                    <option value="">Select a category</option>
                    <?php 
                    // Reset the internal pointer of the result set
                    mysqli_data_seek($categories, 0);
                    while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"
                        <?= ($category['id'] == $blog['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['title']) ?>
                    </option>
                    <?php endwhile ?>
                </select>
            </div>

            <div class="form-group">
                <label for="blogSummary">Brief Summary</label>
                <textarea id="blogSummary" name="summary" rows="3"
                    required><?= htmlspecialchars($blog['summary']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="blogContent">Blog Content</label>
                <textarea id="blogContent" name="content" rows="10"
                    required><?= htmlspecialchars($blog['content']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="blogThumbnail">Change Thumbnail</label>
                <input type="file" id="blogThumbnail" name="thumbnail" accept="image/*" />
                <?php if (!empty($blog['thumbnail'])): ?>
                <p>Current Thumbnail: <?= basename($blog['thumbnail']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn-primary">Update Blog</button>
            </div>
        </form>
    </div>
</main>

<?php
require '../common/footer.php';
?>