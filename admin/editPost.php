<?php
require 'common/header.php';

// Check if post ID is provided
if (!isset($_GET['id'])) {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Fetch post details
$query = "SELECT * FROM posts WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

// Check if post exists and belongs to current user
if (!$post || $post['author_id'] != $_SESSION['user-id']) {
    $_SESSION['post-error'] = "Unauthorized access or post not found";
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>

<main class="container">
    <section class="create-post-section">
        <h1>Edit Spotlight</h1>

        <?php if (isset($_SESSION['post-error'])) : ?>
        <div class="alert_message error">
            <p><?= $_SESSION['post-error']; 
                unset($_SESSION['post-error']); ?></p>
        </div>
        <?php endif ?>

        <form id="edit-post-form" action="<?= ROOT_URL ?>admin/editPostLogic.php" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <div class="form-group">
                <label for="post-title">Spotlight Title</label>
                <input type="text" id="post-title" name="title" value="<?= $post['title'] ?>" />
            </div>
            <div class="form-group">
                <label for="post-description">Description</label>
                <textarea id="post-description" name="description"><?= $post['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="post-media">Upload Media</label>
                <div class="media-upload-container">
                    <input type="file" id="post-media" name="media"
                        accept=".png,.jpg,.jpeg,.gif,.mp4,.avi,.mov,.wmv,.mp3,.wav,.ogg,.pdf,.doc,.docx" />
                    <div class="media-preview">
                        <?php 
                        $extension = strtolower(pathinfo($post['media'], PATHINFO_EXTENSION));
                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo "<img src='" . ROOT_URL . "uploads/" . $post['media'] . "' alt='Media Preview' id='media-preview' />";
                        } else {
                            echo "<p>Current file: " . htmlspecialchars($post['media']) . "</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn">Update Spotlight</button>
        </form>
    </section>
</main>

<script>
document.getElementById('post-media').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('media-preview');

    // Check if file is an image
    if (file.type.match('image.*')) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    }
});
</script>

<?php
require '../common/footer.php';
?>