<?php

require_once 'forms/config.php';


?>

<?php include 'header.php'; ?>

<main class="container py-5" style="position: relative; z-index: 1; padding-top: 150px;">


    <h2 class="text-center mb-4">Admin Settings</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-danger" id="papers-tab" data-bs-toggle="tab" data-bs-target="#papers" type="button" role="tab" aria-controls="papers" aria-selected="true">
                Manage Past Papers
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-danger" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">
                Manage Videos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-danger" id="subscriptions-tab" data-bs-toggle="tab" data-bs-target="#subscriptions" type="button" role="tab" aria-controls="subscriptions" aria-selected="false">
                Manage Subscriptions
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-danger" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab" aria-controls="students" aria-selected="false">
                Manage Students
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="settingsTabsContent">

        <!-- Past Papers -->
        <div class="tab-pane fade show active" id="papers" role="tabpanel" aria-labelledby="papers-tab">
            <h4 class="mb-3">Past Papers</h4>
            <a href="add_paper.php" class="btn btn-danger mb-3">Add New Paper</a>
            <!-- Table of existing papers -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover border border-opacity-50">
                    <thead class="border-bottom border-3">
                        <tr class="bg-black bg-opacity-50">
                            <th class="text-white fw-bold">ID</th>
                            <th class="text-danger fw-bold">Title</th>
                            <th class="text-white fw-bold">Level</th>
                            <th class="text-white fw-bold">Description</th>
                            <th class="text-white fw-bold">File</th>
                            <th class="text-white fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM pastpapers ORDER BY id DESC");
                        $papers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($papers) {
                            foreach ($papers as $paper) {
                                echo "<tr>
                                    <td>{$paper['id']}</td>
                                    <td>{$paper['title']}</td>
                                    <td>{$paper['level']}</td>
                                    <td>{$paper['description']}</td>
                                    <td><a href='{$paper['file_path']}' target='_blank'>View</a></td>
                                    <td>
                                        <a href='edit_paper.php?id={$paper['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='delete_paper.php?id={$paper['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No papers found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Videos -->
        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
            <h4 class="mb-3">Videos</h4>
            <a href="add_video.php" class="btn btn-danger mb-3">Add New Video</a>
            <!-- Table of existing videos -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover border border-opacity-50">
                    <thead class="border-bottom border-3">
                        <tr class="bg-black bg-opacity-50">
                            <th class="text-white fw-bold">ID</th>
                            <th class="text-danger fw-bold">Title</th>
                            <th class="text-white fw-bold">URL</th>
                            <th class="text-white fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM videos ORDER BY id DESC");
                        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($videos) {
                            foreach ($videos as $video) {
                                echo "<tr>
                                    <td>{$video['id']}</td>
                                    <td>{$video['title']}</td>
                                    <td><a href='{$video['url']}' target='_blank'>Watch</a></td>
                                    <td>
                                        <a href='edit_video.php?id={$video['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='delete_video.php?id={$video['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No videos found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Subscriptions -->
        <div class="tab-pane fade" id="subscriptions" role="tabpanel" aria-labelledby="subscriptions-tab">
            <h4 class="mb-3">Subscriptions</h4>
            <!-- Table of subscriptions -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover border border-opacity-50">
                    <thead class="border-bottom border-3">
                        <tr class="bg-black bg-opacity-50">
                            <th class="text-white fw-bold">ID</th>
                            <th class="text-danger fw-bold">User</th>
                            <th class="text-white fw-bold">Email</th>
                            <th class="text-white fw-bold">Plan</th>
                            <th class="text-white fw-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT s.id, u.username, u.email, s.plan, s.status 
                                             FROM subscriptions s 
                                             JOIN users u ON s.user_id = u.id 
                                             ORDER BY s.id DESC");
                        $subs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($subs) {
                            foreach ($subs as $sub) {
                                echo "<tr>
                                    <td>{$sub['id']}</td>
                                    <td>{$sub['username']}</td>
                                    <td>{$sub['email']}</td>
                                    <td>{$sub['plan']}</td>
                                    <td>{$sub['status']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No subscriptions found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Students -->

        <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
            <h4 class="mb-3">Students</h4>
            <!-- Table of students -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover border border-opacity-50">
                    <thead class="border-bottom border-3">
                        <tr class="bg-black bg-opacity-50">
                            <th class="text-white fw-bold">Student ID</th>
                            <th class="text-danger fw-bold">Name</th>
                            <th class="text-white fw-bold">Email</th>
                            <th class="text-white fw-bold">District</th>
                            <th class="text-white fw-bold">Grant Access</th>
                            <th class="text-white fw-bold">Accessible Videos</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $videoStmt = $pdo->query("SELECT id, title FROM videos ORDER BY title ASC");
                        $videosList = $videoStmt->fetchAll(PDO::FETCH_ASSOC);
                        $videoTitleById = [];

                        foreach ($videosList as $videoItem) {
                            $videoTitleById[$videoItem['id']] = $videoItem['title'];
                        }

                        $stmt = $pdo->query("SELECT u.id, u.username, u.email, u.district, 
                                             va.id as access_id, va.video_id, va.accessed_at 
                                             FROM users u 
                                             LEFT JOIN video_access va ON u.id = va.student_id 
                                             ORDER BY u.id DESC");
                        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($students) {
                            foreach ($students as $student) {
                                // Decode video_id JSON if exists
                                $accessibleVideos = 'None';
                                $hasAccess = 'No';
                                
                                if ($student['access_id'] && $student['video_id']) {
                                    $hasAccess = 'Yes';
                                    $videoIds = json_decode($student['video_id'], true);
                                    if (is_array($videoIds) && count($videoIds) > 0) {
                                        $videoTitles = [];
                                        foreach ($videoIds as $videoId) {
                                            $videoTitles[] = $videoTitleById[$videoId] ?? $videoId;
                                        }
                                        $accessibleVideos = implode(', ', $videoTitles);
                                    }
                                }

                                $optionsHtml = "<option value=''>Select video</option>";
                                foreach ($videosList as $videoItem) {
                                    $videoId = $videoItem['id'];
                                    $videoTitle = htmlspecialchars($videoItem['title'], ENT_QUOTES, 'UTF-8');
                                    $optionsHtml .= "<option value='{$videoId}'>{$videoTitle}</option>";
                                }
                                
                                echo "<tr>
                                    <td>{$student['id']}</td>
                                    <td>{$student['username']}</td>
                                    <td>{$student['email']}</td>
                                    <td>{$student['district']}</td>
                                    <td>
                                        <div class='d-flex align-items-center gap-2'>
                                            <select class='form-select form-select-sm video-select bg-transparent text-white border-secondary' data-student-id='{$student['id']}'>
                                                {$optionsHtml}
                                            </select>
                                            <button type='button' class='btn btn-sm btn-danger grant-video-btn' data-student-id='{$student['id']}'>Grant</button>
                                        </div>
                                    </td>
                                    <td>" . $accessibleVideos . "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No students found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</main>

<script>
document.addEventListener('click', function (event) {
    const target = event.target;
    if (!target.classList.contains('grant-video-btn')) {
        return;
    }

    const studentId = target.getAttribute('data-student-id');
    const row = target.closest('tr');
    const select = row ? row.querySelector('.video-select') : null;
    const videoId = select ? select.value : '';

    if (!studentId || !videoId) {
        alert('Please select a video to grant access.');
        return;
    }

    const body = new URLSearchParams({
        student_id: studentId,
        video_id: videoId
    });

    fetch('save_video_access.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: body.toString()
    })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data && data.success) {
                alert('Video access granted.');
                window.location.reload();
            } else {
                alert((data && data.message) ? data.message : 'Failed to grant access.');
            }
        })
        .catch(function () {
            alert('Request failed. Please try again.');
        });
});
</script>

<?php include 'footer.php'; ?>
