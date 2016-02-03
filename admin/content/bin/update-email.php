<?php
include '../../config.php';

$emailcontent = htmlspecialchars($_POST['content'], ENT_QUOTES);
$id = $_GET['id'];

if ($connect->connect_errno) {
  header('Location: ../../index#error');
  exit;
}

if ($content = '') {
  header('Location: ../../index#nocontent');
  exit;
}

$fill = "UPDATE `content` SET `email` = '" . $emailcontent . "' WHERE `id` = " . $id;
if(!mysqli_query($connect1, $fill) === true) {
   die(mysqli_error());
 } else {
   header('Location: ../../index#success');
   exit;
 }
?>
