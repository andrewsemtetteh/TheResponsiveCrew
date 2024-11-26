<?php
require 'common/header.php';

// Verify database connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all portfolios with user details
$portfolio_query = "
    SELECT p.*, u.fullname, u.profile 
    FROM portfolio p
    JOIN users u ON p.author_id = u.id
    ORDER BY p.id DESC
";
$portfolio_result = mysqli_query($connection, $portfolio_query);

// Check query execution
if (!$portfolio_result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<section class="portfolio-section container">
    <div class="portfolio-header">
        <h1>Portfolios</h1>
        <div class="search-filter">
            <input type="search" placeholder="Search Creatives..." id="search-creatives" />
            <select id="filter-creatives">
                <option value="all">All Creatives</option>
                <option value="artist">Artists</option>
                <option value="designer">Designers</option>
                <option value="writer">Writers</option>
                <option value="photographer">Photographers</option>
                <option value="musician">Musicians</option>
                <option value="filmmaker">Filmmakers</option>
            </select>
        </div>
    </div>
    <div class="creatives-grid">
        <?php 
        if (mysqli_num_rows($portfolio_result) > 0) {
            while ($portfolio = mysqli_fetch_assoc($portfolio_result)) {
                // Decode skills safely
                $skills = isset($portfolio['skills']) ? json_decode($portfolio['skills'], true) : [];
                
                // Fallback for profile image
                $profile_image = $portfolio['profile'] 
                    ? htmlspecialchars(ROOT_URL . 'images/' . $portfolio['profile']) 
                    : 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . urlencode($portfolio['fullname']);
                ?>
        <div class="member-card"
            data-creator-type="<?= htmlspecialchars(strtolower($portfolio['creator_type'] ?? '')) ?>">
            <div class="member-banner banner-1"></div>
            <img src="<?= $profile_image ?>" alt="<?= htmlspecialchars($portfolio['fullname']) ?>"
                class="member-avatar" />
            <div class="member-info">
                <h3><?= htmlspecialchars($portfolio['fullname']) ?></h3>
                <p class="member-role"><?= htmlspecialchars(ucfirst($portfolio['creator_type'] ?? 'Creator')) ?></p>

                <?php if (!empty($skills)): ?>
                <div class="member-skills">
                    <?php 
                            // Limit to first 3 skills
                            $display_skills = array_slice($skills, 0, 3);
                            foreach ($display_skills as $skill): ?>
                    <span><?= htmlspecialchars($skill) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="member-actions">
                    <button class="view-btn" data-user-id="<?= $portfolio['author_id'] ?>">View</button>
                    <button class="book-btn">
                        <i class="bx bx-calendar"></i> Book
                    </button>
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo '<p>No portfolios found.</p>';
        }
        ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View profile buttons
    const viewButtons = document.querySelectorAll('.view-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            window.location.href = "<?= ROOT_URL ?>profile.php?id=" + userId;
        });
    });

    // Filter functionality
    const filterSelect = document.getElementById('filter-creatives');
    const memberCards = document.querySelectorAll('.member-card');

    filterSelect.addEventListener('change', function() {
        const selectedType = this.value;

        memberCards.forEach(card => {
            if (selectedType === 'all' || card.getAttribute('data-creator-type') ===
                selectedType) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Search functionality
    const searchInput = document.getElementById('search-creatives');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        memberCards.forEach(card => {
            const name = card.querySelector('h3').textContent.toLowerCase();
            const role = card.querySelector('.member-role').textContent.toLowerCase();

            if (name.includes(searchTerm) || role.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?php
require 'common/footer.php';
?>