<?php
include '../config.php';
$email = $_POST['i_email'];

$query = <<<SQL
SELECT *
FROM `users`
WHERE `email`
= "$email"
SQL;

if ($connect->connect_errno) {
  header('Location: reset#connect_error');
  exit;
}

if (!$result = $connect->query($query)) {
  if ($email == NULL) {
    die('You forgot to fill out the form! <a href="reset?f=username">Click Here</a> to go back');
  } else {
  die('There was an error, sorry! <a href="reset.php?f=username">Click Here</a> to go back, ' . $email . '');
  }
}

$match;

while ($row = $result->fetch_assoc()) {
    $saved = $row['email'];

    if ($email == $saved) {
      $match = true;
      $message = "
      Hello, " . $email . ".
      A failed attempt to log in to your Streampost account resulted in a request for your username.
      If you did not request this, please take the time to secure your account by resetting the password
      and ensuring that your email account information has not been compromised.

      Your username is: " . $row['username'];
    }
    else {
      $match = false;
    }
}

$msg = wordwrap($message, 70, "\r\n");

$headers = "From: auto_respond@" . $index_url . "
X-Mailer: PHP/" . phpversion();

if ($match) {
  mail($email, 'Forgotten Username', $msg, $headers);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name='author' content='Nate Northway' />
  <title>Forgotten Username | Streampost</title>
  <!--Import Google Icon Font-->
  <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
  <!--Import materialize.css-->
  <link type='text/css' rel='stylesheet' href='../../assets/css/materialize.min.css'  media='screen,projection'/>
  <!--Import Custom CSS-->
  <link type='text/css' rel='stylesheet' href='../../assets/css/custom.css' media='all' />

  <!--Let browser know website is optimized for mobile-->
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
  <header>
    <nav>
      <div class='nav-wrapper blue-grey'>
        <div class='container'>
          <a href='#' class='brand-logo'>Forgotten Username</a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class='container'>
      <?php if (!$match) {?>
      <div class='row deep-orange'>
        <div class='col s12 m8 offset-m2'>
          <h4>
            Sorry, but that email doesn't exist in this database :(
            <a href='../reset?f=username' class='black-text'>Click here</a> to go back
          </h4>
        </div>
      <?php } else { ?>
      <div class='row green'>
        <div class='col s12 m8 offset-m2'>
          <h4>
            Great, we've sent you an email with further instructions.
          </h4>
        </div>
      </div>
      <?php } ?>
      </div>
    </div>
  </main>

  <footer class='page-footer blue-grey lighten-3'>
    <div class='container'>
      <div class='col s12'>
        <p>Everything you could ever know is contained in the <a href='../../docs.html'>docs</a></p>
      </div>
    </div>
  </footer>

  <!--Import jQuery before materialize.js-->
  <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
  <script type='text/javascript' src='../../assets/js/materialize.min.js'></script>
  <!--Import custom JS-->
  <script type='text/javascript' src='../../assets/js/custom.js'></script>
  </body>
</html>
