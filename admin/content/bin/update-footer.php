<?php
include '../../config.php';

$footercontent = htmlspecialchars($_POST['content'], ENT_QUOTES);
$id = $_GET['id'];

if ($connect->connect_errno) {
  header('Location: ../footer#error');
  exit;
}

if ($content = '') {
  header('Location: ../footer#nocontent');
  exit;
}

$fill = "UPDATE `content` SET `footer` = '" . $footercontent . "' WHERE `id` = " . $id;
if(!mysqli_query($connect, $fill) === true) {
   die(mysqli_error());
 } else {
   header('Location: ../footer#success');
   exit;
 }
?>
