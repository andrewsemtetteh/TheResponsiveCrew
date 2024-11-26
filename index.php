<?php
    require 'common/header.php';

?>

<section class="hero">
    <div class="container">
        <h1>Ashesi Creatives</h1>
        <h3>Showcase Your Creativity & Connect with Clients</h3>
        <button class="hero-button">Explore Portfolios</button>
    </div>
</section>
</div>

<section id="portfolio" class="portfolio">
    <div class="container">
        <h2 class="section-title">Portfolios</h2>
        <div class="swiper portfolio-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="member-card">
                        <div class="member-banner banner-1"></div>
                        <img src="/images/girl.png" alt="Griselda Owusu-Ansah" class="member-avatar" />
                        <div class="member-info">
                            <h3>Griselda Owusu-Ansah</h3>
                            <p class="member-role">Graphic Designer</p>
                            <div class="member-skills">
                                <span>Photoshop</span>
                                <span>Illustrator</span>
                                <span>Figma</span>
                            </div>
                            <div class="member-actions">
                                <button class="view-btn">View</button>
                                <button class="book-btn">
                                    <i class="bx bx-calendar"></i> Book
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/scripts/script.js"></script>
<script>
const initializeSliders = () => {
    const sliderConfig = {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    };

    new Swiper(".portfolio-slider", {
        ...sliderConfig,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    new Swiper(".blog-slider", sliderConfig);

    new Swiper(".spotlight-slider", {
        ...sliderConfig,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
};

document.addEventListener("DOMContentLoaded", initializeSliders);

document
    .querySelector(".hero-button")
    .addEventListener("click", function() {
        window.location.href = "<?= ROOT_URL ?>portfolio.php";
    });
</script>
</body>

</html>


<?php
    require 'common/footer.php';
?>