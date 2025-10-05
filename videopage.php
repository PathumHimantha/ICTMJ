<?php

require_once 'forms/config.php'; // your DB connection

// PHP function to convert YouTube URL to embed URL
function youtubeEmbed($url) {
    if (strpos($url, 'youtu.be/') !== false) {
        $id = substr(strrchr($url, "/"), 1);
    } else { // normal YouTube URL
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        $id = $params['v'] ?? '';
    }
    return $id ? "https://www.youtube.com/embed/" . $id : '';
}

// Fetch all videos from DB
$stmt = $pdo->query("SELECT * FROM videos ORDER BY created_at DESC");
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include 'header.php'; ?>

<main class="videos-section py-5" style="position: relative; z-index: 1; padding-top: 150px;">
    <div class="container">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold">Video Tutorials</h2>
            <p>Learn ICT through comprehensive video lessons</p>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <div class="card filter-card shadow" style="background: #ffffff3d; border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <select class="form-control" id="filter-category">
                                    <option value="">Select Topic</option>
                                    <option>Programming</option>
                                    <option>Databases</option>
                                    <option>Networks</option>
                                    <option>Hardware</option>
                                    <option>Software</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="filter-level">
                                    <option value="">Select Level</option>
                                    <option>O/L</option>
                                    <option>A/L</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger w-100" id="filter-btn">
                                    <i class="bi bi-search me-2"></i>Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Videos Grid -->
<div class="row g-4" id="videos-container">
    <?php if ($videos): ?>
        <?php foreach ($videos as $video): ?>
        <div class="col-md-6 col-lg-4 video-item" data-category="<?= htmlspecialchars($video['category']) ?>" data-level="<?= htmlspecialchars($video['year']) ?>">
            <div class="card video-card shadow-lg h-100 bg-dark text-white border-0 h-100" style="min-height: 450px;">
                <div class="video-thumbnail position-relative">
                    <iframe width="100%" height="250" 
                        src="<?= youtubeEmbed($video['url']) ?>" 
                        title="<?= htmlspecialchars($video['title']) ?>" 
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                    <span class="duration-badge position-absolute bottom-0 end-0 m-2">Video</span>
                </div>
                <div class="card-body p-3 ">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-camera-video-fill text-danger me-2"></i>
                        <span class="badge bg-danger"><?= htmlspecialchars($video['category']) ?></span>
                    </div>
                    <h5 class="mb-1 text-light fw-bold" style="font-size: 1.1rem;"><?= htmlspecialchars($video['title']) ?></h5>
                    <p class="mb-2" style="font-size: 0.85rem; color:#555;">Year: <?= htmlspecialchars($video['year']) ?></p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <small><i class="bi bi-eye me-1"></i><?= rand(100,5000) ?> views</small>
                        <a href="<?= htmlspecialchars($video['url']) ?>" target="_blank" class="btn btn-danger btn-sm">
                            <i class="bi bi-play-fill me-1"></i>Watch
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-white">No videos found.</p>
    <?php endif; ?>
</div>

    </div>
</main>

<!-- Optional JS for filtering -->
<script>
    const filterBtn = document.getElementById('filter-btn');
    const categorySelect = document.getElementById('filter-category');
    const levelSelect = document.getElementById('filter-level');
    const videoItems = document.querySelectorAll('.video-item');

    filterBtn.addEventListener('click', () => {
        const category = categorySelect.value.toLowerCase();
        const level = levelSelect.value.toLowerCase();

        videoItems.forEach(item => {
            const itemCategory = item.dataset.category.toLowerCase();
            const itemLevel = item.dataset.level.toLowerCase();

            if ((category === '' || itemCategory.includes(category)) &&
                (level === '' || itemLevel.includes(level))) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    
</script>

<?php include 'footer.php'; ?>
