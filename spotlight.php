<?php
  require 'common/header.php';
?>

<main class="container spotlight-container">
    <section class="spotlight-header">
        <h1>Spotlights</h1>
        <button class="create-newpost-btn">
            <i class="bx bx-plus"></i>
            Create New Post
        </button>
    </section>

    <section class="filter-section">
        <div class="search-bar">
            <input type="text" placeholder="Search works..." id="search-input" />
        </div>
        <div class="filter-options">
            <select id="sort-filter">
                <option value="oldest">Oldest</option>
                <option value="recent">Newest</option>
                <option value="popular">Popular</option>
            </select>
        </div>
    </section>

    <div class="gallery-grid" id="gallery-grid">
        <div class="gallery-item" data-type="video">
            <div class="media-container">
                <img src="#" alt="Short Film Preview" />
                <div class="play-overlay">
                    <i class="bx bx-play-circle"></i>
                </div>
            </div>
            <div class="gallery-item-info">
                <span class="media-badge video">Video</span>
                <h3>Urban Life - Short Film</h3>
                <p>A day in the life of city dwellers</p>
                <div class="creator-info">
                    <img src="/images/boy.png" alt="Creator" class="creator-avatar" />
                    <span>Andrew Sem</span>
                </div>
                <div class="item-stats">
                    <span><i class="bx bx-heart"></i> 1.2k</span>
                    <span><i class="bx bx-show"></i> 5.4k</span>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-type="image">
            <div class="media-container">
                <img src="#" alt="Photography Series" />
            </div>
            <div class="gallery-item-info">
                <span class="media-badge image">Photography</span>
                <h3>Nature's Palette</h3>
                <p>Landscape photography series</p>
                <div class="creator-info">
                    <img src="/images/girl.png" alt="Creator" class="creator-avatar" />
                    <span>Griselda Owusu-Ansah</span>
                </div>
                <div class="item-stats">
                    <span><i class="bx bx-heart"></i> 856</span>
                    <span><i class="bx bx-show"></i> 3.2k</span>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-type="design">
            <div class="media-container">
                <img src="#" alt="UI Design" />
            </div>
            <div class="gallery-item-info">
                <span class="media-badge design">UI/UX</span>
                <h3>Mobile App Design</h3>
                <p>Food delivery app interface</p>
                <div class="creator-info">
                    <img src="/images/girl.png" alt="Creator" class="creator-avatar" />
                    <span>Princess Cheryl</span>
                </div>
                <div class="item-stats">
                    <span><i class="bx bx-heart"></i> 734</span>
                    <span><i class="bx bx-show"></i> 2.8k</span>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-type="audio">
            <div class="media-container">
                <img src="#" alt="Music Album" />
                <div class="audio-overlay">
                    <i class="bx bx-music"></i>
                </div>
            </div>
            <div class="gallery-item-info">
                <span class="media-badge audio">Audio</span>
                <h3>Electronic Symphony</h3>
                <p>Original electronic music composition</p>
                <div class="creator-info">
                    <img src="/images/boy.png" alt="Creator" class="creator-avatar" />
                    <span>DJ Paa</span>
                </div>
                <div class="item-stats">
                    <span><i class="bx bx-heart"></i> 523</span>
                    <span><i class="bx bx-show"></i> 1.9k</span>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/scripts/script.js"></script>
<script>
document
    .querySelector(".create-newpost-btn")
    .addEventListener("click", function() {
        window.location.href = "/pages/createpost.html";
    });
</script>
</body>

</html>

<?php

require 'common/footer.php';

?>