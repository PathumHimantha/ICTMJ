<?php include 'header.php'; ?>
<?php include 'forms/config.php'; ?>

<main class="pastpapers-section py-5" style="position: relative; z-index: 1; padding-top: 150px;">
  <div class="container">
    <!-- Page Title -->
    <div class="text-center mb-5">
      <h2 class="text-white display-4 fw-bold">Past Papers</h2>
      <p class="text-white">Download ICT past papers and marking schemes</p>
    </div>

    <!-- Filter Section -->
    <form method="GET" class="row mb-4">
      <div class="col-md-8 mx-auto">
        <div class="card filter-card shadow" style="background: #ffffff3d; border: 1px solid rgba(255, 255, 255, 0.2);">
          <div class="card-body p-4">
            <div class="row g-3">
              <div class="col-md-4">
                <select class="form-control" name="year">
                  <option value="">Select Year</option>
                  <?php
                  // Get distinct years
                  $years = $pdo->query("SELECT DISTINCT year FROM pastpapers ORDER BY year DESC")->fetchAll(PDO::FETCH_COLUMN);
                  foreach ($years as $y) {
                    $selected = ($_GET['year'] ?? '') == $y ? 'selected' : '';
                    echo "<option value='$y' $selected>$y</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="level">
                  <option value="">Select Level</option>
                  <option value="O/L" <?= (($_GET['level'] ?? '') == 'O/L') ? 'selected' : '' ?>>O/L</option>
                  <option value="A/L" <?= (($_GET['level'] ?? '') == 'A/L') ? 'selected' : '' ?>>A/L</option>
                </select>
              </div>
              <div class="col-md-4">
                <button class="btn btn-danger w-100" type="submit">
                  <i class="bi bi-search me-2"></i>Search
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Papers Grid -->
    <div class="row g-4">
      <?php
      $sql = "SELECT * FROM pastpapers WHERE 1=1";
      $params = [];

      if (!empty($_GET['year'])) {
          $sql .= " AND year = :year";
          $params[':year'] = $_GET['year'];
      }
      if (!empty($_GET['level'])) {
          $sql .= " AND level = :level";
          $params[':level'] = $_GET['level'];
      }

      $stmt = $pdo->prepare($sql);
      $stmt->execute($params);
      $papers = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($papers) > 0) {
        foreach ($papers as $paper) {
          $title = htmlspecialchars($paper['title']);
          $desc = htmlspecialchars($paper['description']);
          $file = htmlspecialchars($paper['file_path']);
          $year = htmlspecialchars($paper['year']);
          $level = htmlspecialchars($paper['level']);
          echo "
<div class='col-md-6 col-lg-4'>
  <div class='card paper-card shadow-lg h-100 bg-dark text-white border-0'>
    <div class='card-body p-4'>
      <div class='d-flex align-items-center mb-3'>
        <i class='bi bi-file-earmark-pdf-fill text-danger fs-1 me-3'></i>
        <div>
          <h5 class='mb-1 fw-bold text-white'>$title</h5>
          <span class='badge bg-danger'>$level</span>
        </div>
      </div>
      <p class='mb-3 text-light'>$desc</p>
      <div class='d-flex gap-2'>
        <a href='$file' download class='btn btn-danger flex-fill'>
          <i class='bi bi-download me-2'></i>Download
        </a>
        <a href='$file' target='_blank' class='btn btn-outline-danger'>
          <i class='bi bi-eye'></i>
        </a>
      </div>
    </div>
  </div>
</div>

          ";
        }
      } else {
        echo "<div class='col-12 text-center text-white'><p>No papers found.</p></div>";
      }
      ?>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
