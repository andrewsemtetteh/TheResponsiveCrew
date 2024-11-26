<?php
require 'common/header.php';

// Check if a user ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid profile request";
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

$viewed_user_id = intval($_GET['id']);

// Fetch user details from users table
$user_query = "SELECT id, fullname, profile FROM users WHERE id = ?";
$user_stmt = mysqli_prepare($connection, $user_query);
mysqli_stmt_bind_param($user_stmt, "i", $viewed_user_id);
mysqli_stmt_execute($user_stmt);
$user_result = mysqli_stmt_get_result($user_stmt);
$user = mysqli_fetch_assoc($user_result);

// Check if user exists
if (!$user) {
    $_SESSION['error'] = "User profile not found";
    header('location: ' . ROOT_URL . 'index.php');
    die();
}

// Fetch portfolio details
$portfolio_query = "SELECT * FROM portfolio WHERE author_id = ?";
$portfolio_stmt = mysqli_prepare($connection, $portfolio_query);
mysqli_stmt_bind_param($portfolio_stmt, "i", $viewed_user_id);
mysqli_stmt_execute($portfolio_stmt);
$portfolio_result = mysqli_stmt_get_result($portfolio_stmt);
$portfolio = mysqli_fetch_assoc($portfolio_result);

// Decode JSON fields if they exist
$skills = $portfolio ? json_decode($portfolio['skills'], true) : [];
$socials = $portfolio ? json_decode($portfolio['socials'], true) : [];

// Determine if current user is viewing their own profile
$is_own_profile = isset($_SESSION['user-id']) && $_SESSION['user-id'] == $viewed_user_id;
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

                            <?php if($is_own_profile): ?>
                            <div class="profile-actions">
                                <button class="btn-outline" id="editProfileBtn">
                                    <i class="bx bx-edit"></i>
                                    Edit Profile
                                </button>
                            </div>
                            <?php else: ?>
                            <div class="profile-actions">
                                <button class="book-btn" id="bookingBtn">
                                    <i class="bx bx-calendar"></i>
                                    Book Me
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>

                        <span class="creator-type">
                            <?= $portfolio ? htmlspecialchars($portfolio['creator_type']) : 'Expertise Not Updated' ?>
                        </span>
                    </div>
                </div>

                <p class="profile-bio">
                    <?= $portfolio ? htmlspecialchars($portfolio['bio']) : 'Bio Not Updated' ?>
                </p>

                <div class="skills-section">
                    <h3>Skills</h3>
                    <div class="skills-container">
                        <?php if(!empty($skills)): ?>
                        <ul class="flex flex-wrap gap-2">
                            <?php foreach($skills as $skill): ?>
                            <li class="bg-gray-200 px-2 py-1 rounded text-sm">
                                <?= htmlspecialchars($skill) ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p>No skills updated</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <h3>My Socials</h3>
                    <div class="contact-links flex space-x-4">
                        <?php if(!empty($socials)): ?>
                        <?php if(!empty($socials['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($socials['linkedin']) ?>" target="_blank"
                            class="text-blue-600 hover:underline">
                            LinkedIn
                        </a>
                        <?php endif; ?>

                        <?php if(!empty($socials['github'])): ?>
                        <a href="<?= htmlspecialchars($socials['github']) ?>" target="_blank"
                            class="text-gray-800 hover:underline">
                            GitHub
                        </a>
                        <?php endif; ?>

                        <?php if(!empty($socials['twitter'])): ?>
                        <a href="<?= htmlspecialchars($socials['twitter']) ?>" target="_blank"
                            class="text-blue-400 hover:underline">
                            Twitter/X
                        </a>
                        <?php endif; ?>
                        <?php else: ?>
                        <p>No social links updated</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-works">
        <h2>My Works</h2>
        <div class="works-grid">
            <!-- Placeholder for future works section -->
            <p>No works have been added yet.</p>
        </div>
    </section>
</main>

<?php if($is_own_profile): ?>
<script>
document
    .querySelector("#editProfileBtn")
    .addEventListener("click", function() {
        window.location.href = "<?= ROOT_URL ?>admin/editprofile.php";
    });
<?php endif; ?>
</script>

<?php include 'common/footer.php' ?>