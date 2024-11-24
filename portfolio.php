<?php
  require 'common\header.php';
?>

<section class="portfolio-section container">
    <div class="portfolio-header">
        <h1>Portfolios</h1>
        <div class="search-filter">
            <input type="search" placeholder="Search Creatives..." id="search-creatives" />
            <select id="filter-creatives">
                <option value="all">All Creatives</option>
                <option value="developers">Developers</option>
                <option value="designers">Designers</option>
                <option value="writers">Writers</option>
            </select>
        </div>
    </div>
    <div class="creatives-grid">
        <div class="member-card">
            <div class="member-banner banner-1"></div>
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=John" alt="Andrew Sem Tetteh"
                class="member-avatar" />
            <div class="member-info">
                <h3>Andrew Sem Tetteh</h3>
                <p class="member-role">Full Stack Developer</p>
                <div class="member-skills">
                    <span>JavaScript</span>
                    <span>React</span>
                    <span>Node.js</span>
                </div>
                <div class="member-actions">
                    <button class="view-btn">View</button>
                    <button class="book-btn">
                        <i class="bx bx-calendar"></i> Book
                    </button>
                </div>
            </div>
        </div>

        <div class="member-card">
            <div class="member-banner banner-2"></div>
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah" alt="Griselda Owusu-Ansah"
                class="member-avatar" />
            <div class="member-info">
                <h3>Griselda Owusu-Ansah</h3>
                <p class="member-role">UI/UX Designer</p>
                <div class="member-skills">
                    <span>Figma</span>
                    <span>Adobe XD</span>
                    <span>UI Design</span>
                </div>
                <div class="member-actions">
                    <button class="view-btn">View</button>
                    <button class="book-btn">
                        <i class="bx bx-calendar"></i> Book
                    </button>
                </div>
            </div>
        </div>

        <div class="member-card">
            <div class="member-banner banner-3"></div>
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Mike" alt="Princess Cheryl"
                class="member-avatar" />
            <div class="member-info">
                <h3>Princess Cheryl</h3>
                <p class="member-role">Backend Developer</p>
                <div class="member-skills">
                    <span>Python</span>
                    <span>Django</span>
                    <span>PostgreSQL</span>
                </div>
                <div class="member-actions">
                    <button class="view-btn">View</button>
                    <button class="book-btn">
                        <i class="bx bx-calendar"></i> Book
                    </button>
                </div>
            </div>
        </div>

        <div class="member-card">
            <div class="member-banner banner-4"></div>
            <img src="/images/james.jpg" alt="James Cantamantu-Koomson" class="member-avatar" />
            <div class="member-info">
                <h3>James Cantamantu-Koomson</h3>
                <p class="member-role">Content Writer</p>
                <div class="member-skills">
                    <span>SEO</span>
                    <span>Editing</span>
                </div>
                <div class="member-actions">
                    <button class="view-btn">View</button>
                    <button class="book-btn" id="bookingBtn">
                        <i class="bx bx-calendar"></i> Book
                    </button>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>

<script src="/scripts/script.js"></script>
<script>
document
    .querySelector(".view-btn")
    .addEventListener("click", function() {
        window.location.href = "/pages/profile.html";
    });
</script>
</body>

</html>

<?php
  require 'common/footer.php';
?>