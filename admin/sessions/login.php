<?php
include ('../config.php');


//connect, error check
if ($connect -> connect_errno) {
  header('Location: ../login.html#error');
  exit;
}
//query for the user info
$query = <<<SQL
SELECT *
FROM `users`
SQL;

//error check
if (!$result = $connect->query($query)) {
  header('Location: ../login.html#login_error');
  exit;
}

$user;
$pass;

//get a row of information
while ($row = $result->fetch_assoc()) {

  //store the user and pass
  $user = $row['username'];
  $pass = $row['password'];

  //get what was passed
  $i_user = $_POST['user'];
  $i_pass = md5($_POST['pass']);

  if ($i_user === $user && $i_pass === $pass) {
    session_start();
    $_SESSION['name'] = $user;
    $_SESSION['time'] = time();
    header('Location: ../index');
    exit;
  } else if ($i_user != $user) {
    header('Location: ../login.html#wrong_user');
    exit;
  } else if ($i_pass != $pass) {
    header('Location: ../login.html#wrong_pass');
    exit;
  }
}
?>
