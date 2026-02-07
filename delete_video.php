<?php
require_once 'forms/config.php';

$videoId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($videoId <= 0) {
    header('Location: settings.php?tab=videos');
    exit;
}

// Delete from videos table
$deleteStmt = $pdo->prepare("DELETE FROM videos WHERE id = :id");
$deleteStmt->bindParam(':id', $videoId, PDO::PARAM_INT);
$deleteStmt->execute();

// Clean up video_access entries that reference this video ID
$accessStmt = $pdo->query("SELECT id, video_id FROM video_access WHERE video_id IS NOT NULL AND video_id <> ''");
$accessRows = $accessStmt->fetchAll(PDO::FETCH_ASSOC);

if ($accessRows) {
    $updateStmt = $pdo->prepare("UPDATE video_access SET video_id = :video_id WHERE id = :id");

    foreach ($accessRows as $row) {
        $ids = json_decode($row['video_id'], true);
        if (!is_array($ids)) {
            continue;
        }

        $filtered = array_values(array_filter($ids, function ($id) use ($videoId) {
            return (int)$id !== $videoId;
        }));

        if ($filtered !== $ids) {
            $newValue = count($filtered) ? json_encode($filtered) : null;
            $updateStmt->execute([
                ':video_id' => $newValue,
                ':id' => (int)$row['id']
            ]);
        }
    }
}

header('Location: settings.php?tab=videos');
exit;
?>
