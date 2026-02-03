<?php include 'header.php'; ?>
<?php
include 'forms/config.php';

// ✅ Debug connection
if ($pdo) {
  echo "<!-- ✅ DB connection OK -->";
} else {
  echo "<!-- ❌ DB connection failed -->";
}

?>
<main class="main">
  <!-- Hero Section -->
  <section id="hero" class="hero section transparent-background">
    <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2>ICT WITH MALINDA JAYASIRI</h2>
          <p>Master ICT concepts with expert guidance and prepare confidently for your O/L examination.</p>
        </div>
        <div class="countdown d-flex justify-content-center" data-count="2025/12/03">
          <div><h3 class="count-days">0</h3><h4>Days</h4></div>
          <div><h3 class="count-hours">0</h3><h4>Hours</h4></div>
          <div><h3 class="count-minutes">0</h3><h4>Minutes</h4></div>
          <div><h3 class="count-seconds">0</h3><h4>Seconds</h4></div>
        </div>
      </div>
    </div>
  </section>

<!-- User Table Section -->
  <section id="users" class="section transparent-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="section-title">
        <h2 class="text-white fw-bold">Registered Users</h2>
        <p class="text-white-50">Manage all registered users here</p>
      </div>

      <!-- Filter Form -->
      <form method="GET" class="mb-4 p-4 bg-trns bg-opacity-25 rounded border border-danger border-opacity-50">
        <div class="row g-3">
          <div class="col-md-4">
            <input 
              type="text" 
              name="username" 
              class="form-control  text-white border-white border-opacity-25"
              placeholder="Search by Username"
              value="<?php echo htmlspecialchars($_GET['username'] ?? '', ENT_QUOTES); ?>">
          </div>
          <div class="col-md-4">
            <input 
              type="text" 
              name="district" 
              class="form-control  text-white border-white border-opacity-25"
              placeholder="Search by District"
              value="<?php echo htmlspecialchars($_GET['district'] ?? '', ENT_QUOTES); ?>">
          </div>
          <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-danger w-100 fw-bold">Filter</button>
            <a href="admin.php" class="btn btn-outline-light w-100">Reset</a>
          </div>
        </div>
      </form>

      <!-- Users Table -->
      <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover border  border-opacity-50">
          <thead class="border-bottom  border-3">
            <tr class="bg-black bg-opacity-50">
              <th class="text-white fw-bold">ID</th>
              <th class="text-danger fw-bold">Username</th>
              <th class="text-white fw-bold">Email</th>
              <th class="text-white fw-bold">Phone</th>
              <th class="text-white fw-bold">District</th>
              <th class="text-white fw-bold">Created At</th>
            </tr>
          </thead>
          <tbody>
<?php
// ✅ Debug: incoming filters
echo "<!-- DEBUG: GET parameters -->";
echo "<!-- " . print_r($_GET, true) . " -->";

$username = $_GET['username'] ?? '';
$district = $_GET['district'] ?? '';

$sql = "SELECT id, username, email, password, created_at, phone, district FROM users WHERE 1=1";
$params = [];

if (!empty($username)) {
    $sql .= " AND username LIKE :username";
    $params[':username'] = "%$username%";
}

if (!empty($district)) {
    $sql .= " AND district LIKE :district";
    $params[':district'] = "%$district%";
}

// ✅ Debug: Final SQL + Params
echo "<!-- DEBUG: Final SQL = $sql -->";
echo "<!-- DEBUG: Params = " . print_r($params, true) . " -->";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Debug: query result
    echo "<!-- DEBUG: Row count = " . count($users) . " -->";

    if (count($users) > 0) {
        foreach ($users as $row) {
            echo "<tr class='bg-transparent'>";
            echo "<td class='text-white-50'>{$row['id']}</td>";
            echo "<td class='text-danger fw-bold'>{$row['username']}</td>";
            echo "<td class='text-white'>{$row['email']}</td>";
            echo "<td class='text-white'>{$row['phone']}</td>";
            echo "<td class='text-white'>{$row['district']}</td>";
            echo "<td class='text-white-50'>{$row['created_at']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center text-white-50 fst-italic py-4'>No users found.</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='6' class='text-danger fw-bold bg-danger bg-opacity-10 p-3 text-center'>Query error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
