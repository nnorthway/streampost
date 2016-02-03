<?php
include '../config.php';
include '../sessions/config.php';

$active = check_session();

$id = $_GET['id'];

if (!$active) {
  header('Location: ../login.html');
  exit;
}

$query = <<<SQL
DELETE FROM
`users`
WHERE `id`
= $id
SQL;

if($result = $connect->query($query)) {
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset='utf-8' />
      <meta name='author' content='Nate Northway' />
      <title>Delete User | Streampost</title>
      <!--Import Google Icon Font-->
      <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
      <!--Import materialize.css-->
      <link type='text/css' rel='stylesheet' href='../../assets/css/materialize.min.css'  media='screen,projection'/>
      <!--Import Custom CSS-->
      <link type='text/css' rel='stylesheet' href='../../assets/css/custom.css' media='all' />

      <!--Let browser know website is optimized for mobile-->
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body class='grey lighten-5 admin-page'>
    <header>
      <ul id='slide-out' class='side-nav fixed'>
          <ul id='top-nav-menu'>
            <li>
              <a href='../../docs.html'>
                <i class='material-icons small center'>info</i>
              </a>
            </li>
            <li>
              <a href='../../index'>
                <i class='material-icons small center'>home</i>
              </a>
            </li>
            <li>
              <a href='../sessions/logout'>
                <i class='material-icons small center'>lock</i>
              </a>
            </li>
          </ul>
        <li>
          <a href='../index'>Control Center<i class='material-icons small right'>web</i></a>
        </li>
        <li>
          <a href='../posts/post'>New Post<i class='material-icons small right'>send</i></a>
        </li>
        <li>
          <a href='../posts/post-editor'>Post Editor<i class='material-icons small right'>border_color</i></a>
        </li>
        <li>
          <a href='../content/sidebar'>Sidebar Editor<i class='material-icons small right'>border_right</i></a>
        </li>
        <li>
          <a href='../content/footer'>Footer Editor<i class='material-icons small right'>border_bottom</i></a>
        </li>
        <li class='active'>
          <a href='user-admin'>User Administration<i class='material-icons small right'>account_box</i></a>
        </li>
        <li>
          <a href='../../index'>Blog Home<i class='material-icons small right'>home</i></a>
        </li>
        <li>
          <a href='../sessions/logout'>Logout<i class='material-icons small right'>lock</i></a>
        </li>
        <li>
          <a href='../../docs.html'>Docs/Help<i class='material-icons small right'>info</i></a>
        </li>
      </ul>
      <nav class='blue-grey hide-on-large-only'>
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
            <p>Need help? Check out the <a href='../../docs.html'>docs</a></p>
          </div>
        </div>
      </footer>

      <!--Import jQuery before materialize.js-->
      <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
      <script type='text/javascript' src='..././assets/js/materialize.min.js'></script>
      <!--Import custom JS-->
      <script type='text/javascript' src='../../assets/js/custom.js'></script>
  </body>
</html>
<?php } else { echo "there was an issue deleting your post"; } ?>
