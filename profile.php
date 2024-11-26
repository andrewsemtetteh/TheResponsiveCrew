<?php
  require 'common\header.php';
?>

<main class="container mx-auto p-4 space-y-8">
    <section class="profile-section">
        <div class="profile-container">
            <div class="profile-image-container">
                <img src="/images/boy.png" alt="Profile Picture" class="profile-image" />
            </div>

            <div class="profile-content">
                <div class="profile-header">
                    <div class="profile-info">
                        <div class="name-and-actions">
                            <h1 class="profile-name">Andrew Sem Tetteh</h1>
                            <div class="profile-actions">
                                <button class="btn-outline" id="editProfileBtn">
                                    <i class="bx bx-edit"></i>
                                    Edit Profile
                                </button>
                                <button class="book-btn" id="bookingBtn">
                                    <i class="bx bx-calendar"></i>
                                    Book Me
                                </button>
                            </div>
                        </div>
                        <span class="creator-type">Web Developer</span>
                    </div>
                </div>

                <p class="profile-bio">
                    Creative professional with a passion for design and photography.
                    Showcasing my best work in this portfolio.
                </p>

                <div class="skills-section">
                    <h3>Skills</h3>
                    <div class="skills-container">
                        <span class="skill-tag">UI Design</span>
                        <span class="skill-tag">Digital Art</span>
                        <span class="skill-tag">Illustration</span>
                        <span class="skill-tag">Figma</span>
                        <span class="skill-tag">Adobe Creative Suite</span>
                    </div>
                </div>

                <div>
                    <h3>My Socials</h3>
                    <div class="contact-links">
                        <a href="#" class="contact-link">
                            <i class="bx bx-envelope"></i> Email Me
                        </a>
                        <a href="#" class="contact-link">
                            <i class="bx bxl-linkedin"></i> LinkedIn
                        </a>
                        <a href="#" class="contact-link">
                            <i class="bx bxl-instagram"></i> Instagram
                        </a>
                        <a href="#" class="contact-link">
                            <i class="bx bxl-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-works">
        <h2>My Works</h2>
        <div class="works-grid">
            <div class="work-card">
                <img src="/images/bg.webp" alt="Project 1" />
                <div class="work-info">
                    <h3>Project Title</h3>
                    <p>Project description goes here</p>
                </div>
            </div>
            <div class="work-card">
                <img src="/images/africanfood.jpg" alt="Project 2" />
                <div class="work-info">
                    <h3>Project Title</h3>
                    <p>Project description goes here</p>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal" id="bookingModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Book Me</h2>
            <button class="close-modal">&times;</button>
        </div>
        <form class="booking-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Your name" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Your email" />
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" placeholder="Tell me about your project"></textarea>
            </div>
            <button type="submit" class="btn-primary">Book</button>
        </form>
    </div>
</div>

<script>
// redirection to the edit profile page
document
    .querySelector("#editProfileBtn")
    .addEventListener("click", function() {
        window.location.href = "<?= ROOT_URL ?>admin/editprofile.php";
    });
</script>
</body>

</html>


<?php
include 'common/footer.php'

?>