<?php
include '../../config.php';
//path = $db_url/admin/content/bin

$titlecontent = htmlspecialchars($_POST['content'], ENT_QUOTES);
$id = $_GET['id'];

if ($connect->connect_errno) {
  header('Location: ../../index#error');
  exit;
}

if ($content = '') {
  header('Location: ../../index#nocontent');
  exit;
}

$fill = "UPDATE `content` SET `header` = '" . $titlecontent . "' WHERE `id` = " . $id;
if(!mysqli_query($connect1, $fill) === true) {
   die($connect->error);
 } else {
   header('Location: ../../index#success');
   exit;
 }
?>
