<?php
session_start();
require_once 'config.php';

// Only allow admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    header('Location: ../index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $category = trim($_POST['category']);
    $url = trim($_POST['url']);

    if (!$title || !$year || !$category || !$url) {
        $error = "All fields are required!";
    } else {
        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO videos (title, year, category, url, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$title, $year, $category, $url])) {
            $success = "Video added successfully!";
        } else {
            $error = "Database insertion failed.";
        }
    }
}
?>

<?php include 'header.php'; ?>

<main class="container py-5" style="padding-top: 150px;">
    <h2 class="text-center mb-4">Add New Video</h2>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter video title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" placeholder="2024" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="O/L">O/L</option>
                <option value="A/L">A/L</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">YouTube URL</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-youtube text-danger"></i></span>
                <input type="url" name="url" class="form-control" placeholder="https://www.youtube.com/..." required>
            </div>
        </div>

        <button type="submit" class="btn btn-danger">Add Video</button>
        <a href="settings.php?tab=videos" class="btn btn-secondary">Back</a>
    </form>
</main>

<?php include 'footer.php'; ?>
