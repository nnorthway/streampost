<?php
include '../../config.php';

$id = $_GET['id'];
$username = $_POST['username'];
$email = $_POST['email'];

if (isset($_POST['password'])) {
  $password = md5($_POST['password']);
  $query = "UPDATE `users` SET `username` = '" . $username . "', `password` = '" . $password . "', `email` = '" . $email . "' WHERE `id` = " . $id;
} else {
  $query = "UPDATE `users` SET `username` = '" . $username . "', `email` = '" . $email . "' WHERE `id` = " . $id;
}

if ($connect->connect_errno) {
  header('Location: ../user-admin#error');
  exit;
}

$connect->query($query);

header('Location: ../user-admin#success');
exit;

?>
