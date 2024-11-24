<?php

require 'common/header.php';
?>

<main class="container">
    <section class="create-post-section">
        <h1>Create Spotlight</h1>
        <form id="create-post-form" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post-title">Spotlight Title</label>
                <input type="text" id="post-title" required />
            </div>
            <div class="form-group">
                <label for="post-description">Description</label>
                <textarea id="post-description" required></textarea>
            </div>
            <div class="form-group">
                <label for="post-media">Upload Media</label>
                <div class="media-upload-container">
                    <input type="file" id="post-media" required />
                    <div class="media-preview">
                        <img src="#" alt="Media Preview" id="media-preview" />
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn">Create Spotlight</button>
        </form>
    </section>
</main>

<script src="/scripts/createpost.js"></script>
</body>

</html>

<?php
  require '../common/footer.php';
?>