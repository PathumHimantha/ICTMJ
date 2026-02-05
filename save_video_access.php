<?php
session_start();
include 'forms/config.php';

header('Content-Type: application/json');

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 0) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? null;
    $video_id = $_POST['video_id'] ?? null;

    if (!$student_id || !$video_id) {
        echo json_encode(['success' => false, 'message' => 'Missing parameters']);
        exit;
    }

    try {
        // Load student details for insert if needed
        $studentStmt = $pdo->prepare("SELECT username, email, district FROM users WHERE id = :student_id");
        $studentStmt->execute([':student_id' => $student_id]);
        $student = $studentStmt->fetch(PDO::FETCH_ASSOC);

        if (!$student) {
            echo json_encode(['success' => false, 'message' => 'Student not found']);
            exit;
        }

        // Check if student has video access record
        $stmt = $pdo->prepare("SELECT video_id FROM video_access WHERE student_id = :student_id");
        $stmt->execute([':student_id' => $student_id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Update existing record - add video to array
            $current_videos = !empty($existing['video_id']) ? json_decode($existing['video_id'], true) : [];
            
            // Ensure it's an array
            if (!is_array($current_videos)) {
                $current_videos = [];
            }
            
            // Add new video if not already in array
            if (!in_array($video_id, $current_videos)) {
                $current_videos[] = $video_id;
            }
            
            $updated_videos = json_encode($current_videos);
            
            $stmt = $pdo->prepare("UPDATE video_access SET video_id = :video_id, accessed_at = NOW() WHERE student_id = :student_id");
            $stmt->execute([
                ':video_id' => $updated_videos,
                ':student_id' => $student_id
            ]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Video access updated',
                'videos' => $current_videos
            ]);
        } else {
            $videos = json_encode([$video_id]);
            $insert = $pdo->prepare("INSERT INTO video_access (student_id, name, email, district, video_id, accessed_at)
                                     VALUES (:student_id, :name, :email, :district, :video_id, NOW())");
            $insert->execute([
                ':student_id' => $student_id,
                ':name' => $student['username'],
                ':email' => $student['email'],
                ':district' => $student['district'],
                ':video_id' => $videos
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'Video access created',
                'videos' => [$video_id]
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
