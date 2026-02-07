<?php
require_once 'forms/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accessId = $_POST['access_id'] ?? '';

    if (empty($accessId)) {
        echo json_encode(['success' => false, 'message' => 'Access ID is required.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM video_access WHERE id = :access_id");
        $stmt->bindParam(':access_id', $accessId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Video access removed successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove video access.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>