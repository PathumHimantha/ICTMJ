<?php

require_once 'forms/config.php';


?>

<?php include 'header.php'; ?>

<main class="container py-5" style="position: relative; z-index: 1; padding-top: 150px;">


    <h2 class="text-center mb-4">Admin Settings</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="papers-tab" data-bs-toggle="tab" data-bs-target="#papers" type="button" role="tab" aria-controls="papers" aria-selected="true">
                Manage Past Papers
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">
                Manage Videos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="subscriptions-tab" data-bs-toggle="tab" data-bs-target="#subscriptions" type="button" role="tab" aria-controls="subscriptions" aria-selected="false">
                Manage Subscriptions
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
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Level</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Actions</th>
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
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Actions</th>
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
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Status</th>
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

    </div>

</main>

<?php include 'footer.php'; ?>
