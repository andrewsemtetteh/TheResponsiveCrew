<?php
  require 'common\header.php';
?>

<main class="blog-post-container">
    <article class="blog-post">
        <div class="blog-post-header">
            <div class="post-category">Creative Writing</div>
            <div class="blog-post-meta">
                <div class="blog-post-info">
                    <div class="author-info">
                        <img src="/images/boy.png" alt="Author" class="author-avatar" />
                        <div class="author-details">
                            <span class="author-name">Andrew Sem Tetteh</span>
                            <span class="post-date">March 15, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="blog-post-title">The Art of Creative Expression</h1>
        </div>

        <img src="/images/africanfood.jpg" alt="Blog Featured Image" class="featured-image" />

        <div class="blog-content">
            <p class="description">
                Exploring the boundless possibilities of creative expression through
                various mediums and perspectives. Discover how different artists
                interpret and convey their unique visions.
            </p>

            <h2>The Journey Begins</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum. Sed ut
                perspiciatis unde omnis iste natus error sit voluptatem accusantium
                doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo.
            </p>
        </div>
    </article>

    <section class="comments-section">
        <h2 class="comments-title">Comments (2)</h2>

        <div class="comment-form">
            <form class="comment-input-form">
                <textarea placeholder="Add a comment..." rows="3"></textarea>
                <button type="submit" class="comment-submit">Post Comment</button>
            </form>
        </div>

        <div class="comments-list">
            <div class="comment">
                <img src="/images/girl.png" alt="Commenter" class="comment-avatar" />
                <div class="comment-content">
                    <div class="comment-header">
                        <h4 class="commenter-name">Griselda Owusu-Ansah</h4>
                        <span class="comment-date">2 days ago</span>
                    </div>
                    <p class="comment-text">
                        This is such an insightful article! I particularly enjoyed the
                        section about finding your voice. It resonates with my own
                        creative journey.
                    </p>
                    <button class="reply-btn">Reply</button>
                </div>
            </div>

            <div class="comment">
                <img src="/images/boy.png" alt="Commenter" class="comment-avatar" />
                <div class="comment-content">
                    <div class="comment-header">
                        <h4 class="commenter-name">Princess Cheryl</h4>
                        <span class="comment-date">1 day ago</span>
                    </div>
                    <p class="comment-text">
                        Great perspective on creative expression! Would love to see a
                        follow-up article about specific techniques and exercises.
                    </p>
                    <button class="reply-btn">Reply</button>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="/scripts/script.js"></script>
</body>

</html>


<?php
include 'common/footer.php'

?>