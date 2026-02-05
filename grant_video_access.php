<?php
require_once 'forms/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? null;
    $video_ids = $_POST['video_ids'] ?? [];
    
    if ($student_id) {
        try {
            // Get student information
            $studentStmt = $pdo->prepare("SELECT username, email, district FROM users WHERE id = ?");
            $studentStmt->execute([$student_id]);
            $student = $studentStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($student) {
                // Check if student already has video access record
                $checkStmt = $pdo->prepare("SELECT id FROM video_access WHERE student_id = ?");
                $checkStmt->execute([$student_id]);
                $existingAccess = $checkStmt->fetch(PDO::FETCH_ASSOC);
                
                // Convert video IDs array to JSON
                $videoIdsJson = json_encode(array_map('intval', $video_ids));
                
                if ($existingAccess) {
                    // Update existing record
                    if (empty($video_ids)) {
                        // Delete access if no videos selected
                        $deleteStmt = $pdo->prepare("DELETE FROM video_access WHERE student_id = ?");
                        $deleteStmt->execute([$student_id]);
                    } else {
                        // Update with new video IDs
                        $updateStmt = $pdo->prepare("UPDATE video_access 
                                                    SET video_id = ?, accessed_at = CURRENT_TIMESTAMP 
                                                    WHERE student_id = ?");
                        $updateStmt->execute([$videoIdsJson, $student_id]);
                    }
                } else {
                    // Insert new record if videos are selected
                    if (!empty($video_ids)) {
                        $insertStmt = $pdo->prepare("INSERT INTO video_access 
                                                    (student_id, name, email, district, video_id) 
                                                    VALUES (?, ?, ?, ?, ?)");
                        $insertStmt->execute([
                            $student_id,
                            $student['username'],
                            $student['email'],
                            $student['district'],
                            $videoIdsJson
                        ]);
                    }
                }
                
                // Redirect back with success message
                header("Location: admin_settings.php?tab=students&success=1");
                exit;
            }
        } catch (PDOException $e) {
            // Redirect back with error message
            header("Location: admin_settings.php?tab=students&error=" . urlencode($e->getMessage()));
            exit;
        }
    }
}

// If something went wrong, redirect back
header("Location: admin_settings.php?tab=students");
exit;
?>