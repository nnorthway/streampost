<?php
include '../../config.php';

if ($connect->connect_errno) {
  header('Location: ../add-user.php#error');
  exit;
}

$username = $_POST['username'];
$unhashed = $_POST['password'];
$password = md5($_POST['password']);
$email = $_POST['email'];


if ($username === '' || $password === '' || $email === '') {
  header('Location: ../add-user#empty');
  exit;
}

$fill = "INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, '$username', '$password', '$email')";

$message = "
Hello, " . $username . "\r\n
Your Streampost Login was recently activated.\r\n
Your username is " . $username . "
Your password is " . $unhashed . "
If you believe you have recieved this email in error, please contact the site manager at http://" . $db_url . "

----------------------------------------------------------
This is an automated email. Any response will not be seen.
";

$headers = "From: new-user@" . $index_url . " " . "\r\n" .
"Reply-To: " . $contact . "\r\n" .
"X-Mailer: PHP/" . phpversion();

$msg = wordwrap($message, 70, "\r\n");

mail($email, 'New Streampost User', $msg, $headers);

$connect->query($fill);

header('Location: ../user-admin#success');
exit;

?>
