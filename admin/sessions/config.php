<?php
function check_session() {
  session_start();
  if (isset($_SESSION['name'])) {
    $x = time() - $_SESSION['time'];
    if ($x < 3600) {
      return true;
    } else {
      return false;
    }
    exit;
  } else if (!isset($_SESSION['name'])) {
    return false;
  }
}
 ?>
