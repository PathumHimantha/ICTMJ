
<?php include 'header.php'; ?>
<?php
// If session is empty but we have cookie data, populate session
if ((!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    error_log("Session populated from cookie - user_id: " . $_COOKIE['user_id']);
}

if ((!isset($_SESSION['username']) || empty($_SESSION['username'])) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    error_log("Session populated from cookie - username: " . $_COOKIE['username']);
}


$is_admin = false;

// Convert to int for proper comparison (user_id could be string "0")
if (isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === 0) {
    $is_admin = true;
    error_log("User is ADMIN (user_id = 0)");
} else {
    error_log("User is NOT admin. user_id = " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NOT SET'));
}

?>

<?php
// Start session if not already started
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

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

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$user_id = $is_logged_in ? (int) $_SESSION['user_id'] : null;

// Check if user is admin (user_id = 0)
$is_admin = $is_logged_in && $user_id === 0;

// Fetch all videos from DB
$stmt = $pdo->query("SELECT * FROM videos ORDER BY created_at DESC");
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Load accessible video IDs for logged-in users (not admin)
$accessible_ids = [];
if ($is_logged_in && !$is_admin) {
    try {
        $access_stmt = $pdo->prepare("SELECT video_id FROM video_access WHERE student_id = :student_id");
        $access_stmt->execute([':student_id' => $user_id]);
        $access_row = $access_stmt->fetch(PDO::FETCH_ASSOC);

        if ($access_row && !empty($access_row['video_id'])) {
            // Decode JSON array of video IDs
            $decoded = json_decode($access_row['video_id'], true);
            if (is_array($decoded)) {
                // Convert all values to integers for comparison
                $accessible_ids = array_map('intval', $decoded);
            }
        }
    } catch (PDOException $e) {
        // Handle error silently or log it
        error_log("Video access error: " . $e->getMessage());
    }
}
?>



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
        <?php
            $video_id = (int) $video['id'];
            // Admin has access to all videos, regular users check accessible_ids array
            $has_access = $is_admin || ($is_logged_in && in_array($video_id, $accessible_ids));
        ?>
        <div class="col-md-6 col-lg-4 video-item" data-category="<?= htmlspecialchars($video['category']) ?>" data-level="<?= htmlspecialchars($video['year']) ?>">
            <div class="card video-card shadow-lg h-100 bg-dark text-white border-0 h-100" style="min-height: 450px;">
                <div class="video-thumbnail position-relative">
                    <?php if ($has_access): ?>
                        <!-- Show actual video for accessible videos -->
                        <iframe width="100%" height="250"
                            src="<?= youtubeEmbed($video['url']) ?>"
                            title="<?= htmlspecialchars($video['title']) ?>" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    <?php else: ?>
                        <!-- Show blurred thumbnail for inaccessible videos -->
                        <iframe width="100%" height="250"
                            src="<?= youtubeEmbed($video['url']) ?>"
                            title="<?= htmlspecialchars($video['title']) ?>" 
                            frameborder="0">
                        </iframe>
                       
                    <?php endif; ?>
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
                        <?php if ($has_access): ?>
                            <!-- User has access - show direct link -->
                            <a href="<?= htmlspecialchars($video['url']) ?>" target="_blank" class="btn btn-danger btn-sm">
                                <i class="bi bi-play-fill me-1"></i>Watch
                            </a>
                        <?php elseif ($is_logged_in): ?>
                            <!-- User is logged in but doesn't have access - show payment message -->
                            <button type="button" class="btn btn-danger btn-sm watch-btn" data-bs-toggle="modal" data-bs-target="#accessModal" data-msg="You need to pay to access this video.">
                                <i class="bi bi-lock-fill me-1"></i>Watch
                            </button>
                        <?php else: ?>
                            <!-- User is not logged in - show login message -->
                            <button type="button" class="btn btn-danger btn-sm watch-btn" data-bs-toggle="modal" data-bs-target="#accessModal" data-msg="You need to login or register to watch videos.">
                                <i class="bi bi-lock-fill me-1"></i>Watch
                            </button>
                        <?php endif; ?>
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

<!-- Access Modal -->
<div class="modal fade" id="accessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title">Access Required</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="accessModalBody">
        You need to login or register to watch videos.
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

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

    const watchButtons = document.querySelectorAll('.watch-btn');
    const accessModalBody = document.getElementById('accessModalBody');

    watchButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const msg = btn.getAttribute('data-msg') || 'Access required.';
            accessModalBody.textContent = msg;
        });
    });
</script>

<?php include 'footer.php'; ?>