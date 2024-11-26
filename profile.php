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
                                <?php if(isset($_SESSION['user-id'])): ?>
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
                        <span class="creator-type">Expertise (Not updated)</span>
                    </div>
                </div>

                <p class="profile-bio">Bio (Not updated)</p>

                <div class="skills-section">
                    <h3>Skills</h3>
                    <div class="skills-container">
                        <p>Skills not updated</p>
                    </div>
                </div>

                <div>
                    <h3>My Socials</h3>
                    <div class="contact-links">
                        <p>Socials not updated</p>
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
// Redirection to the edit profile page
document
    .querySelector("#editProfileBtn")
    .addEventListener("click", function() {
        window.location.href = "<?= ROOT_URL ?>admin/editprofile.php";
    });
</script>

<?php
include 'common/footer.php'
?>