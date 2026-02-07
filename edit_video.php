<?php

require_once 'forms/config.php';

$error = '';
$success = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    $error = 'Invalid video ID.';
}

$video = null;
if (!$error) {
    $stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
    $stmt->execute([$id]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$video) {
        $error = 'Video not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $category = trim($_POST['category']);
    $url = trim($_POST['url']);

    if (!$title || !$year || !$category || !$url) {
        $error = 'All fields are required!';
    } else {
        $stmt = $pdo->prepare("UPDATE videos SET title = ?, year = ?, category = ?, url = ? WHERE id = ?");
        if ($stmt->execute([$title, $year, $category, $url, $id])) {
            $success = 'Video updated successfully!';
            $stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
            $stmt->execute([$id]);
            $video = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error = 'Database update failed.';
        }
    }
}
?>

<?php include 'header.php'; ?>

<main class="container py-5" style="position: relative; z-index: 1; padding-top: 150px;">
    <h2 class="text-center mb-4">Edit Video</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="settings.php" class="btn btn-secondary">Back</a>
    <?php else: ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($video['title']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" required value="<?= htmlspecialchars($video['year']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="O/L" <?= ($video['category'] === 'O/L') ? 'selected' : '' ?>>O/L</option>
                    <option value="A/L" <?= ($video['category'] === 'A/L') ? 'selected' : '' ?>>A/L</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">YouTube URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-youtube text-danger"></i></span>
                    <input type="url" name="url" class="form-control" required value="<?= htmlspecialchars($video['url']) ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-danger">Update Video</button>
            <a href="settings.php?tab=videos" class="btn btn-secondary">Back</a>
        </form>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
