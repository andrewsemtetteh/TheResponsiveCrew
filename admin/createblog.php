<?php

require 'common/header.php';
?>

<main class="container">
    <div class="blog-form-container">
        <h1>Create New Blog</h1>
        <form id="blogPostForm" class="blog-form" enctype="multipart/form-data" action="">
            <div class="form-group">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="blogTitle" required />
            </div>

            <div class="form-group">
                <label for="blogCategory">Category</label>
                <select id="blogCategory" name="blogCategory" required>
                    <option value="">Select a category</option>
                    <option value="1">Technology</option>
                    <option value="1">Design</option>
                    <option value="1">Development</option>
                    <option value="1">Career</option>
                    <option value="1">Lifestyle</option>
                </select>
            </div>

            <div class="form-group">
                <label for="blogThumbnail">Change Thumbnail</label>
                <div class="file-upload">
                    <input type="file" id="blogThumbnail" name="blogThumbnail" accept="image/*" />
                    <label for="blogThumbnail" class="file-upload-label">
                        <i class="bx bx-upload"></i>
                        Choose Image
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="blogSummary">Brief Summary</label>
                <textarea id="blogSummary" name="blogSummary" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Blog Content</label>

                <div id="editor" class="content-editor" contenteditable="true"></div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Publish Blog</button>
            </div>
        </form>
    </div>
</main>

<script src="/scripts/script.js"></script>
</body>

</html>

<?php
  require '../common/footer.php';
?>