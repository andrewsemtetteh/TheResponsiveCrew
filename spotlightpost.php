<?php
  require 'common\header.php';
?>

<main class="container spotlightpost-container">
    <section class="post-wrapper">
        <div class="post-header">
            <div class="header-top">
                <div class="creator-info">
                    <img id="creator-avatar" src="/images/boy.png" alt="Creator" class="creator-avatar" />
                    <div class="creator-details">
                        <span id="creator-name">Griselda Owusu-Ansah</span>
                        <span id="post-time">2 days ago</span>
                    </div>
                </div>
                <h1 id="post-title">Futuristic Robot 3D Model</h1>
            </div>
        </div>
        <div class="media-container">
            <model-viewer id="post-media" src="/models/robot.glb" alt="Futuristic Robot 3D Model" auto-rotate
                camera-controls></model-viewer>
        </div>
        <div class="post-details">
            <p id="post-description">
                A detailed 3D model of a futuristic robot, perfect for sci-fi
                projects. Includes fully rigged and articulated components for
                dynamic animations.
            </p>
            <div class="item-stats">
                <span><i class="bx bx-heart"></i>
                    <span id="likes-count">687</span></span>
                <span><i class="bx bx-show"></i>
                    <span id="views-count">2.4k</span></span>
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