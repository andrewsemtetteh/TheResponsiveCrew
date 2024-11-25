<?php
require '../common/header.php';

//get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;

unset($_SESSION['add-category-data']);

?>

<main class="container">
    <section class="add-category-section">
        <h1>Add Category</h1>
        <form id="add-category-form" action="<?= ROOT_URL ?>admin/addCategoryLogic.php" method="POST">
            <div class="form-group">
                <label for="category-title">Category Title</label>
                <input type="text" id="category-title" name="title" required />
            </div>
            <button type="submit" name="submit" class="submit-btn">Create Category</button>
        </form>
    </section>
</main>

<?php
require '../common/footer.php';
?>