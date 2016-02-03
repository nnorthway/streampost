<?php
include '../../config.php';

$sidebarcontent = htmlspecialchars($_POST['content'], ENT_QUOTES);
$id = $_GET['id'];

if ($connect->connect_errno) {
  header('Location: ../sidebar#error');
  exit;
}

if ($content = '') {
  header('Location: ../sidebar#nocontent');
  exit;
}

$fill = "UPDATE `content` SET `about` = '" . $sidebarcontent . "' WHERE `id` = " . $id;
if(!mysqli_query($connect1, $fill) === true) {
   die(mysqli_error());
 } else {
   header('Location: ../sidebar#success');
   exit;
 }
?>
