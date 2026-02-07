<?php

require_once 'forms/config.php';

$error = '';
$success = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    $error = 'Invalid paper ID.';
}

$paper = null;
if (!$error) {
    $stmt = $pdo->prepare("SELECT * FROM pastpapers WHERE id = ?");
    $stmt->execute([$id]);
    $paper = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$paper) {
        $error = 'Past paper not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $level = trim($_POST['level']);
    $description = trim($_POST['description']);

    if (!$title || !$year || !$level) {
        $error = 'Title, Year, and Level are required.';
    } else {
        $newFilePath = $paper['file_path'];

        if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === 0) {
            $allowed = ['pdf', 'doc', 'docx'];
            $filename = $_FILES['file_path']['name'];
            $filetmp = $_FILES['file_path']['tmp_name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed, true)) {
                $uploadDir = 'uploads/papers/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $newFileName = uniqid() . "-" . $filename;
                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($filetmp, $destination)) {
                    $newFilePath = $destination;
                } else {
                    $error = 'Failed to upload file.';
                }
            } else {
                $error = 'Invalid file type. Only PDF, DOC, DOCX allowed.';
            }
        }

        if (!$error) {
            $stmt = $pdo->prepare("UPDATE pastpapers SET title = ?, year = ?, level = ?, description = ?, file_path = ? WHERE id = ?");
            if ($stmt->execute([$title, $year, $level, $description, $newFilePath, $id])) {
                $success = 'Past paper updated successfully!';
                $stmt = $pdo->prepare("SELECT * FROM pastpapers WHERE id = ?");
                $stmt->execute([$id]);
                $paper = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $error = 'Database update failed.';
            }
        }
    }
}
?>

<?php include 'header.php'; ?>

<main class="container py-5" style="position: relative; z-index: 1; padding-top: 150px;">
    <h2 class="text-center mb-4">Edit Past Paper</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="settings.php" class="btn btn-secondary">Back</a>
    <?php else: ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($paper['title']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" required value="<?= htmlspecialchars($paper['year']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Level</label>
                <select name="level" class="form-control" required>
                    <option value="">Select Level</option>
                    <option value="O/L" <?= ($paper['level'] === 'O/L') ? 'selected' : '' ?>>O/L</option>
                    <option value="A/L" <?= ($paper['level'] === 'A/L') ? 'selected' : '' ?>>A/L</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($paper['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Current File</label>
                <div>
                    <a href="<?= htmlspecialchars($paper['file_path']) ?>" target="_blank">View current file</a>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload New File (optional)</label>
                <input type="file" name="file_path" class="form-control" accept=".pdf,.doc,.docx">
            </div>

            <button type="submit" class="btn btn-danger">Update Paper</button>
            <a href="settings.php" class="btn btn-secondary">Back</a>
        </form>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
