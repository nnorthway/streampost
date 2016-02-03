<?php
//all the form info
$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
$id = $_GET['id'];

include '../../config.php';

if ($connect->connect_errno) {
  header('Location: ../post#error');
  exit;
}

if ($title == '') {
  header('Location: ../post#nocontent');
  exit;
}
$fill = "UPDATE `posts` SET `title` = '" . $title . "', `content` = '" . $content . "' WHERE `id` = " . $id;
$connect->query($fill);

header('Location: ../post#success');
exit;

 ?>
