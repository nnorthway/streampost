<?php
include '../../config.php';
include '../../sessions/config.php';

$active = check_session();

$id = $_GET['id'];

if (!$active) {
  header('Location: login.html');
  exit;
}

$query = <<<SQL
DELETE FROM
`posts`
WHERE `id`
= '$id'
SQL;

if($connect->query($query)) {
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset='utf-8' />
      <meta name='author' content='Nate Northway' />
      <title>Update Post | Streampost</title>
      <!--Import Google Icon Font-->
      <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
      <!--Import materialize.css-->
      <link type='text/css' rel='stylesheet' href='../../../assets/css/materialize.min.css'  media='screen,projection'/>
      <!--Import Custom CSS-->
      <link type='text/css' rel='stylesheet' href='../../../assets/css/custom.css' media='all' />

      <!--Let browser know website is optimized for mobile-->
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body class='grey lighten-5 admin-page'>
    <header>
      <ul id='slide-out' class='side-nav fixed'>
        <li>
          <a href='../../index'>Control Center</a>
        </li>
        <li>
          <a href='../post'>New Post</a>
        </li>
        <li class='active'>
          <a href='../post-editor'>Post Editor</a>
        </li>
        <li>
          <a href='../../content/sidebar'>Sidebar Editor</a>
        </li>
        <li>
          <a href='../../content/footer'>Footer Editor</a>
        </li>
        <li>
          <a href='../../users/user-admin'>User Administration</a>
        </li>
        <li>
          <a href='../../../index'>Blog Home</a>
        </li>
        <li>
          <a href='../../sessions/logout'>Logout</a>
        </li>
      </ul>
      <nav class='blue-grey'>
        <a href='#' data-activates='slide-out' class='button-collapse'><i class='mdi-navigation-menu'></i></a>
        <div class='container'>
          <a href='#' class='brand-logo'>Delete Post</a>
        </div>
      </nav>
    </header>

      <main>
        <div class='container'>
          <div class='row'>
            <div class='col s12 m8'>
              <h4>Your entry has been deleted</h4>
            </div>
         </div>
        </div>
      </main>

      <footer class='page-footer blue-grey lighten-3'>
        <div class='container'>
          <div class='col s12'>
            <p>Need help? Check out the <a href='../../../docs.html'>docs</a></p>
          </div>
        </div>
      </footer>

      <!--Import jQuery before materialize.js-->
      <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
      <script type='text/javascript' src='../../../assets/js/materialize.min.js'></script>
      <!--Import custom JS-->
      <script type='text/javascript' src='../../../assets/js/custom.js'></script>
  </body>
</html>
<?php } else { echo "there was an issue deleting your post"; } ?>
