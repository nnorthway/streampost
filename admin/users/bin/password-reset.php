<?php
include '../../config.php';

$new = md5($_POST['new_pass']);
$user = $_GET['u'];

$fill = "UPDATE `users` SET `password` = '" . $new . "' WHERE `username` = '" . $user . "'";

if ($connect->connect_errno) {
  header('Location: ../../login.html#login_error');
  exit;
}

if ($new === '') {
  header('Location: ../pass-reset#empty');
  exit;
}
if(!mysqli_query($connect1, $fill) === true) {
   die(mysqli_error());
 } else {
   header('Location: ../../login.html#resetsuccess');
   exit;
 }


?>
