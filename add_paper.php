<?php

require_once 'forms/config.php';


$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $level = trim($_POST['level']);
    $description = trim($_POST['description']);

    // Handle file upload
    if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === 0) {
        $allowed = ['pdf', 'doc', 'docx'];
        $filename = $_FILES['file_path']['name'];
        $filetmp = $_FILES['file_path']['tmp_name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $uploadDir = 'uploads/papers/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $newFileName = uniqid() . "-" . $filename;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($filetmp, $destination)) {
                // Insert into DB
                $stmt = $pdo->prepare("INSERT INTO pastpapers (title, year, level, description, file_path, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                if ($stmt->execute([$title, $year, $level, $description, $destination])) {
                    $success = "Past paper added successfully!";
                } else {
                    $error = "Database insertion failed.";
                }
            } else {
                $error = "Failed to upload file.";
            }
        } else {
            $error = "Invalid file type. Only PDF, DOC, DOCX allowed.";
        }
    } else {
        $error = "Please upload a file.";
    }
}
?>

<?php include 'header.php'; ?>

<main class="container py-5" style="position: relative; z-index: 1; padding-top: 150px;">
    <h2 class="text-center mb-4">Add New Past Paper</h2>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <select name="level" class="form-control" required>
                <option value="">Select Level</option>
                <option value="O/L">O/L</option>
                <option value="A/L">A/L</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
<div class="mb-3">
    <label class="form-label">Upload File</label>
    <div class="file-drop-zone" id="fileDropZone">
        <i class="bi bi-upload fs-2 text-danger mb-2"></i>
        <p class="mb-0">Drag & Drop your file here or click to upload</p>
        <input type="file" name="file_path" id="fileInput" accept=".pdf,.doc,.docx" required>
    </div>
</div>
        <button type="submit" class="btn btn-danger">Add Paper</button>
        <a href="settings.php" class="btn btn-secondary">Back</a>
    </form>
</main>
<style>
.file-drop-zone {
    position: relative;
    border: 2px dashed #dc3545; /* Bootstrap danger color */
    border-radius: 8px;
    padding: 40px;
    text-align: center;
    cursor: pointer;
    background-color: #1a1a1a; /* dark background */
    color: #fff;
    transition: background-color 0.3s, border-color 0.3s;
}
.file-drop-zone:hover {
    background-color: #2a2a2a;
    border-color: #ff4d4d;
}
.file-drop-zone input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}
.file-drop-zone p {
    font-size: 16px;
    color: #fff;
}
</style>

<script>
// Optional: show file name when selected
const fileDropZone = document.getElementById('fileDropZone');
const fileInput = document.getElementById('fileInput');

fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        fileDropZone.querySelector('p').textContent = `Selected: ${fileInput.files[0].name}`;
    }
});

// Drag over styling
fileDropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileDropZone.style.backgroundColor = '#333';
    fileDropZone.style.borderColor = '#ff4d4d';
});
fileDropZone.addEventListener('dragleave', () => {
    fileDropZone.style.backgroundColor = '#1a1a1a';
    fileDropZone.style.borderColor = '#dc3545';
});
</script>
<?php include 'footer.php'; ?>
