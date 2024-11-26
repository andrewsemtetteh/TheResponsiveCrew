<?php
require '../common/header.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user-id'])) {
    $_SESSION['error'] = "You must be logged in to edit your profile";
    header('location: ' . ROOT_URL . 'login.php');
    die();
}

// Fetch current user's profile information
$user_id = $_SESSION['user-id'];
$portfolio_query = "SELECT * FROM portfolio WHERE author_id = ?";
$stmt = mysqli_prepare($connection, $portfolio_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$portfolio_result = mysqli_stmt_get_result($stmt);
$portfolio = mysqli_fetch_assoc($portfolio_result);

// Fetch user details
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($connection, $user_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($user_result);

// Prepare skills and socials
$skills = $portfolio ? json_decode($portfolio['skills'], true) : [];
$socials = $portfolio ? json_decode($portfolio['socials'], true) : [];
?>

<main class="container mx-auto p-4">
    <section class="edit-profile-section">
        <h1>Edit Profile</h1>
        <form class="edit-profile-form" id="editProfileForm" action="<?= ROOT_URL ?>admin/editprofileLogic.php"
            method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <div class="image-section">
                    <div class="profile-image-container">
                        <img src="<?= $user['profile'] ? ROOT_URL . 'images/' . $user['profile'] : '/images/boy.png' ?>"
                            alt="Profile Picture" id="profilePreview" class="profile-image" />
                        <div class="image-upload-overlay">
                            <label for="profile" class="upload-label">
                                <i class="bx bx-camera"></i>
                                <span>Change Photo</span>
                            </label>
                            <input type="file" id="profile" name="profile" accept="image/*" hidden />
                        </div>
                    </div>
                </div>

                <div class="form-content">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullname"
                            value="<?= htmlspecialchars($user['fullname']) ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="creator_type">Creator Type</label>
                        <select id="creator_type" name="creator_type" required>
                            <option value="">Select creator type</option>
                            <option value="artist"
                                <?= ($portfolio && $portfolio['creator_type'] == 'artist') ? 'selected' : '' ?>>Artist
                            </option>
                            <option value="photographer"
                                <?= ($portfolio && $portfolio['creator_type'] == 'photographer') ? 'selected' : '' ?>>
                                Photographer</option>
                            <option value="designer"
                                <?= ($portfolio && $portfolio['creator_type'] == 'designer') ? 'selected' : '' ?>>
                                Designer</option>
                            <option value="writer"
                                <?= ($portfolio && $portfolio['creator_type'] == 'writer') ? 'selected' : '' ?>>Writer
                            </option>
                            <option value="musician"
                                <?= ($portfolio && $portfolio['creator_type'] == 'musician') ? 'selected' : '' ?>>
                                Musician</option>
                            <option value="filmmaker"
                                <?= ($portfolio && $portfolio['creator_type'] == 'filmmaker') ? 'selected' : '' ?>>
                                Filmmaker</option>
                            <option value="other"
                                <?= ($portfolio && $portfolio['creator_type'] == 'other') ? 'selected' : '' ?>>Other
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                            required><?= $portfolio ? htmlspecialchars($portfolio['bio']) : '' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Skills</label>
                        <div class="skills-input-container">
                            <div class="skills-tags">
                                <?php if (!empty($skills)): ?>
                                <?php foreach ($skills as $skill): ?>
                                <span class="skill-tag">
                                    <?= htmlspecialchars($skill) ?>
                                    <button type="button" class="remove-skill">&times;</button>
                                </span>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="skills" id="skillsInput" />
                            <input type="text" id="skillInput" placeholder="Add a skill and press Enter" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Social Links</label>
                        <div class="social-links-container">
                            <div class="social-input">
                                <i class="bx bxl-linkedin"></i>
                                <input type="url" name="linkedin" placeholder="LinkedIn profile URL"
                                    value="<?= isset($socials['linkedin']) ? htmlspecialchars($socials['linkedin']) : '' ?>" />
                            </div>
                            <div class="social-input">
                                <i class="bx bxl-github"></i>
                                <input type="url" name="github" placeholder="GitHub profile URL"
                                    value="<?= isset($socials['github']) ? htmlspecialchars($socials['github']) : '' ?>" />
                            </div>
                            <div class="social-input">
                                <i class="bx bxl-twitter"></i>
                                <input type="url" name="twitter" placeholder="Twitter profile URL"
                                    value="<?= isset($socials['twitter']) ? htmlspecialchars($socials['twitter']) : '' ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-outline" id="cancelBtn">
                            Cancel
                        </button>
                        <button type="submit" name="submit" class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<script>
const profileInput = document.getElementById("profile");
const profilePreview = document.getElementById("profilePreview");

profileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            profilePreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

const skillInput = document.getElementById("skillInput");
const skillsContainer = document.querySelector(".skills-tags");
const skillsInputHidden = document.getElementById("skillsInput");

// Collect skills when page loads
function updateSkillsInput() {
    const skillTags = document.querySelectorAll(".skill-tag");
    const skills = Array.from(skillTags).map(tag => tag.firstChild.textContent.trim());
    skillsInputHidden.value = skills.join(',');
}

// Initial update on page load
updateSkillsInput();

skillInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
        e.preventDefault();
        const skill = skillInput.value.trim();
        if (skill) {
            const skillTag = document.createElement("span");
            skillTag.className = "skill-tag";
            skillTag.innerHTML = `
              ${skill}
              <button type="button" class="remove-skill">&times;</button>
            `;
            skillsContainer.appendChild(skillTag);
            skillInput.value = "";
            updateSkillsInput();
        }
    }
});

skillsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-skill")) {
        e.target.parentElement.remove();
        updateSkillsInput();
    }
});

const cancelBtn = document.getElementById("cancelBtn");
cancelBtn.addEventListener("click", () => {
    window.location.href = "<?= ROOT_URL ?>profile.php";
});
</script>

<?php
require '../common/footer.php';
?>