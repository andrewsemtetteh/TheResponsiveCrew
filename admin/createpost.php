<?php
require 'common/header.php';
?>

<main class="container">
    <section class="create-post-section">
        <h1>Create Spotlight</h1>

        <?php if (isset($_SESSION['post-error'])) : ?>
        <div class="alert_message error">
            <p><?= $_SESSION['post-error']; 
                unset($_SESSION['post-error']); ?></p>
        </div>
        <?php endif ?>

        <form id="create-post-form" action="<?= ROOT_URL ?>admin/createpostLogic.php" method="POST"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="post-title">Spotlight Title</label>
                <input type="text" id="post-title" name="title" />
            </div>
            <div class="form-group">
                <label for="post-description">Description</label>
                <textarea id="post-description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="post-media">Upload Media</label>
                <div class="media-upload-container">
                    <input type="file" id="post-media" name="media"
                        accept=".png,.jpg,.jpeg,.gif,.mp4,.avi,.mov,.wmv,.mp3,.wav,.ogg,.pdf,.doc,.docx" />
                    <div class="media-preview">
                        <img src="#" alt="Media Preview" id="media-preview" style="display:none;" />
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn">Create Spotlight</button>
        </form>
    </section>
</main>

<script>
document.getElementById('post-media').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('media-preview');

    // Reset preview
    preview.style.display = 'none';

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