<?php
  require 'common\header.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}

// Fetch user details from database
$user_id = $_SESSION['user-id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Fetch portfolio details
$portfolio_query = "SELECT * FROM portfolio WHERE author_id = ?";
$stmt = mysqli_prepare($connection, $portfolio_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$portfolio_result = mysqli_stmt_get_result($stmt);
$portfolio = mysqli_fetch_assoc($portfolio_result);

// Prepare skills and socials if portfolio exists
$skills = $portfolio ? json_decode($portfolio['skills'], true) : [];
$socials = $portfolio ? json_decode($portfolio['socials'], true) : [];
?>

<main class="container mx-auto p-4 space-y-8">
    <section class="profile-section">
        <div class="profile-container">
            <div class="profile-image-container">
                <?php if($user && $user['profile']): ?>
                <img src="<?= ROOT_URL ?>images/<?= htmlspecialchars($user['profile']) ?>" alt="Profile Picture"
                    class="profile-image" />
                <?php else: ?>
                <img src="/images/boy.png" alt="Default Profile Picture" class="profile-image" />
                <?php endif; ?>
            </div>

            <div class="profile-content">
                <div class="profile-header">
                    <div class="profile-info">
                        <div class="name-and-actions">
                            <h1 class="profile-name">
                                <?= htmlspecialchars($user['fullname']) ?>
                            </h1>
                            <div class="profile-actions">
                                <?php 
                                // Check if the logged-in user is the profile owner
                                if(isset($_SESSION['user-id']) && $_SESSION['user-id'] == $user_id): ?>
                                <button class="btn-outline" id="editProfileBtn">
                                    <i class="bx bx-edit"></i>
                                    Edit Profile
                                </button>
                                <?php else: ?>
                                <button class="book-btn" id="bookingBtn">
                                    <i class="bx bx-calendar"></i>
                                    Book Me
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <span class="creator-type">
                            <?= $portfolio ? htmlspecialchars(ucfirst($portfolio['creator_type'])) : 'Expertise Not Updated' ?>
                        </span>
                    </div>
                </div>

                <p class="profile-bio">
                    <?= $portfolio ? htmlspecialchars($portfolio['bio']) : 'Bio Not Updated' ?>
                </p>

                <div class="skills-section">
                    <h3>Skills</h3>
                    <div class="skills-container">
                        <?php if (!empty($skills)): ?>
                        <?php foreach ($skills as $skill): ?>
                        <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p>No skills added</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <h3>My Socials</h3>
                    <div class="contact-links">
                        <?php if (!empty($socials)): ?>
                        <?php if (!empty($socials['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($socials['linkedin']) ?>" target="_blank">
                            <i class="bx bxl-linkedin"></i>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($socials['github'])): ?>
                        <a href="<?= htmlspecialchars($socials['github']) ?>" target="_blank">
                            <i class="bx bxl-github"></i>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($socials['twitter'])): ?>
                        <a href="<?= htmlspecialchars($socials['twitter']) ?>" target="_blank">
                            <i class="bx bxl-twitter"></i>
                        </a>
                        <?php endif; ?>
                        <?php else: ?>
                        <p>No social links added</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-works">
        <h2>My Works</h2>
        <div class="works-grid">
            <p>Works not updated</p>
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
            <p>Booking form not updated</p>
        </form>
    </div>
</div>

<script>
// Only add event listener for edit profile if the button exists
const editProfileBtn = document.querySelector("#editProfileBtn");
if (editProfileBtn) {
    editProfileBtn.addEventListener("click", function() {
        window.location.href = "<?= ROOT_URL ?>admin/editprofile.php";
    });
}

// Optional: Add event listener for booking button if needed
const bookingBtn = document.querySelector("#bookingBtn");
if (bookingBtn) {
    bookingBtn.addEventListener("click", function() {
        // Add booking modal logic here if required
        document.getElementById("bookingModal").style.display = "block";
    });

    // Close modal functionality
    document.querySelector(".close-modal").addEventListener("click", function() {
        document.getElementById("bookingModal").style.display = "none";
    });
}
</script>

<?php
include 'common/footer.php'
?>