<?php
include '../config.php';

$in_id = $_GET['id'];
$in_time = $_GET['init'];

$query = <<<SQL
SELECT *
FROM `users`
SQL;

if ($connect->connect_errno) {
  header('Location: reset#connect_error');
  exit;
}

if (!$result = $connect->query($query)) {
  die("Sorry, there was an error processing your request. ");
  exit;
}

while ($row = $result->fetch_assoc()) {
  $row_id = md5($row['username']);
  $username = $row['username'];
  if ($in_id != $row_id) {
    header('Location: ../login.html#login_error');
    exit;
  }

$current_time = time();

if (($current_time - $in_time) > 3600) {
  header('Location: ../login.html#timeout');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <meta name='author' content='Nate Northway' />
  <title>Forgotten Password | Streampost</title>
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
          <a href='#' class='brand-logo'>Forgotten Password</a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class='container'>
      <div class='row'>
        <div class='col s12 m6 offset-m3 deep-orange error-message' id='empty'>
          <h4>You didn't enter anything</h4>
          <p>Are you sure you're a human?</p>
        </div>
      </div>
      <div class='row'>
        <h4>To reset your password, enter your new password below:</h4>
        <form action='bin/password-reset?u=<?php echo $username; ?>' method='post'>
          <div class='input-field'>
            <input type='password' name='new_pass' id='new_pass' required/>
            <label for='new_pass'>New Password</label>
          </div>
          <button class='btn waves-effect waves-light'>Submit</button>
        </form>
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
<?php } ?>
