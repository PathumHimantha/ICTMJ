<?php
require_once 'forms/config.php';

$paperId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($paperId <= 0) {
    header('Location: settings.php?tab=papers');
    exit;
}

// Get file path before deleting the record
$stmt = $pdo->prepare("SELECT file_path FROM pastpapers WHERE id = :id");
$stmt->bindParam(':id', $paperId, PDO::PARAM_INT);
$stmt->execute();
$paper = $stmt->fetch(PDO::FETCH_ASSOC);

// Delete record
$deleteStmt = $pdo->prepare("DELETE FROM pastpapers WHERE id = :id");
$deleteStmt->bindParam(':id', $paperId, PDO::PARAM_INT);
$deleteStmt->execute();

// Remove file from disk if it exists
if ($paper && !empty($paper['file_path']) && file_exists($paper['file_path'])) {
    @unlink($paper['file_path']);
}

header('Location: settings.php?tab=papers');
exit;
?>
