<?php
require 'common/header.php';

// Check if ID is set in URL
if(isset($_GET['id'])) {
    $category_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // Fetch the current category details
    $query = "SELECT * FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($result);

    // If no category found, redirect
    if(!$category) {
        $_SESSION['edit-category-error'] = "Category not found";
        header('Location: ' . ROOT_URL . 'admin/manageCategory.php');
        exit();
    }
} else {
    header('Location: ' . ROOT_URL . 'admin/manageCategory.php');
    exit();
}
?>

<main class="container">
    <section class="add-category-section">
        <h1>Edit Category</h1>
        <form id="add-category-form" action="<?= ROOT_URL ?>admin/editCategoryLogic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <div class="form-group">
                <label for="category-title">Category Title</label>
                <input type="text" id="category-title" name="title" value="<?= htmlspecialchars($category['title']) ?>"
                    required />
            </div>

            <button type="submit" name="submit" class="submit-btn">Update Category</button>
        </form>
    </section>
</main>

</body>

</html>

<?php
  require '../common/footer.php';
?>