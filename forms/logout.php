<?php
session_start();
session_destroy();

// clear localStorage too
echo "<script>
    localStorage.clear();
window.location.href = '../index.php';

</script>";
exit();
