 <?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
   
   
    <!-- Videos Section -->
    <main class="videos-section py-5" style="position: relative; z-index: 1; padding-top: 150px;">
        <div class="container">
            <!-- Page Title -->
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold">Video Tutorials</h2>
                <p>Learn ICT through comprehensive video lessons</p>
            </div>

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-md-8 mx-auto">
                    <div class="card filter-card shadow">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option>Select Topic</option>
                                        <option>Programming</option>
                                        <option>Databases</option>
                                        <option>Networks</option>
                                        <option>Hardware</option>
                                        <option>Software</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option>Select Level</option>
                                        <option>Beginner</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-danger w-100">
                                        <i class="bi bi-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Videos Grid -->
            <div class="row g-4">
                <!-- Video Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">15:30</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Programming</span>
                            </div>
                            <h5 class="mb-2">Introduction to Python</h5>
                            <p class="mb-3">Learn the basics of Python programming language</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>1.2K views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">22:45</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Databases</span>
                            </div>
                            <h5 class="mb-2">SQL Fundamentals</h5>
                            <p class="mb-3">Master SQL queries and database management</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>856 views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">18:20</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Networks</span>
                            </div>
                            <h5 class="mb-2">Network Protocols</h5>
                            <p class="mb-3">Understanding TCP/IP and network communication</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>943 views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Card 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">12:15</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Hardware</span>
                            </div>
                            <h5 class="mb-2">Computer Components</h5>
                            <p class="mb-3">Learn about CPU, RAM, and storage devices</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>1.5K views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Card 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">20:30</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Software</span>
                            </div>
                            <h5 class="mb-2">Operating Systems</h5>
                            <p class="mb-3">Deep dive into Windows, Linux, and macOS</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>2.1K views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Card 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card video-card shadow-lg h-100">
                        <div class="video-thumbnail">
                            <img src="assets/img/bg.jpg" class="card-img-top" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-circle-fill text-danger"></i>
                            </div>
                            <span class="duration-badge">16:40</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-camera-video-fill text-danger me-2"></i>
                                <span class="badge bg-danger">Programming</span>
                            </div>
                            <h5 class="mb-2">Web Development Basics</h5>
                            <p class="mb-3">HTML, CSS, and JavaScript for beginners</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="bi bi-eye me-1"></i>3.2K views</small>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Watch
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>