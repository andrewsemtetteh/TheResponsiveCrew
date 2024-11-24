<?php

require 'common/header.php';
?>

<main class="container mx-auto p-4">
    <section class="edit-profile-section">
        <h1>Edit Profile</h1>
        <form class="edit-profile-form" id="editProfileForm">
            <div class="form-container">
                <div class="image-section">
                    <div class="profile-image-container">
                        <img src="/images/boy.png" alt="Profile Picture" id="profilePreview" class="profile-image" />
                        <div class="image-upload-overlay">
                            <label for="profileImage" class="upload-label">
                                <i class="bx bx-camera"></i>
                                <span>Change Photo</span>
                            </label>
                            <input type="file" id="profileImage" accept="image/*" hidden />
                        </div>
                    </div>
                </div>

                <div class="form-content">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" value="Andrew Sem Tetteh" required />
                    </div>

                    <div class="form-group">
                        <label for="creatorType">Creator Type</label>
                        <select id="creatorType" required>
                            <option value="">Select creator type</option>
                            <option value="artist">Artist</option>
                            <option value="photographer">Photographer</option>
                            <option value="designer">Designer</option>
                            <option value="writer">Writer</option>
                            <option value="musician">Musician</option>
                            <option value="filmmaker">Filmmaker</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" rows="4" required>
Creative professional with a passion for design and photography. Showcasing my best work in this portfolio.</textarea>
                    </div>

                    <div class="form-group">
                        <label>Skills</label>
                        <div class="skills-input-container">
                            <div class="skills-tags">
                                <span class="skill-tag">
                                    UI Design
                                    <button type="button" class="remove-skill">
                                        &times;
                                    </button>
                                </span>
                                <span class="skill-tag">
                                    Digital Art
                                    <button type="button" class="remove-skill">
                                        &times;
                                    </button>
                                </span>
                                <span class="skill-tag">
                                    Illustration
                                    <button type="button" class="remove-skill">
                                        &times;
                                    </button>
                                </span>
                            </div>
                            <input type="text" id="skillInput" placeholder="Add a skill and press Enter" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Social Links</label>
                        <div class="social-links-container">
                            <div class="social-input">
                                <i class="bx bx-envelope"></i>
                                <input type="email" placeholder="Email address" />
                            </div>
                            <div class="social-input">
                                <i class="bx bxl-linkedin"></i>
                                <input type="url" placeholder="LinkedIn profile URL" />
                            </div>
                            <div class="social-input">
                                <i class="bx bxl-instagram"></i>
                                <input type="url" placeholder="Instagram profile URL" />
                            </div>
                            <div class="social-input">
                                <i class="bx bxl-whatsapp"></i>
                                <input type="url" placeholder="WhatsApp profile URL" />
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-outline" id="cancelBtn">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<script src="/scripts/script.js"></script>

<script>
const profileInput = document.getElementById("profileImage");
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
        }
    }
});

skillsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-skill")) {
        e.target.parentElement.remove();
    }
});

const editProfileForm = document.getElementById("editProfileForm");
editProfileForm.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("Form submitted");
});

const cancelBtn = document.getElementById("cancelBtn");
cancelBtn.addEventListener("click", () => {
    window.location.href = "/pages/spotlight.html";
});
</script>
</body>

</html>

<?php
  require '../common/footer.php';
?>