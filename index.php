<?php
include 'admin/config.php';
include 'admin/sessions/config.php';

$active = check_session();

if (!isset($not_setup)) {
  header('Location: setup.html#not_setup');
  exit;
}

if ($connect->connect_errno) {
  header('Location: docs.html#setup-problems');
  exit;
}

$content_query = <<<SQL
SELECT *
FROM `content`
SQL;

$post_query = <<<SQL
SELECT *
FROM `posts`
ORDER BY `id`
DESC
SQL;
//error checking

if(!$content_result = $connect->query($content_query)) {
  die('There was an error fetching content: ' . $connect->error . '. Oops');
}

if(!$post_result = $connect->query($post_query)) {
  die('There was an error fetching posts: ' . $connect->error . '. Oops');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <meta name='author' content='Nate Northway' />
    <title><?php while($content_row = $content_result->fetch_assoc()) { echo $content_row['header']; ?></title>
    <!--Import Google Icon Font-->
    <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
    <!--Import materialize.css-->
    <link type='text/css' rel='stylesheet' href='assets/css/materialize.min.css'  media='screen,projection'/>
    <!--Import Custom CSS-->
    <link type='text/css' rel='stylesheet' href='assets/css/custom.css' media='all' />

    <!--Let browser know website is optimized for mobile-->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body class='grey lighten-5'>
    <header>
      <nav>
        <div class='nav-wrapper blue-grey'>
          <div class='container'>
            <a href='#' class='brand-logo'><?php echo htmlspecialchars_decode($content_row['header']); ?></a>
            <a href='#' data-activates='mob-nav' class='button-collapse'><i class='material-icons'>menu</i></a>
            <ul class='right hide-on-med-and-down'>
              <?php if($active) { ?>
              <li>
                <a href='admin/index'>Control Center<i class='material-icons small right'>web</i></a>
              </li>
              <li>
                <a href='admin/sessions/logout'>Logout<i class='material-icons small right'>lock</i></a>
              </li>
              <?php } else { ?>
              <li>
                <a href='admin/login.html'>Login<i class='material-icons small right'>lock_open</i></a>
              </li><?php } ?>
            </ul>
            <ul class='side-nav' id='mob-nav'>
              <?php if($active) { ?>
              <li>
                <a href='admin/index'>Control Center<i class='material-icons small right'>web</i></a>
              </li>
              <li>
                <a href='admin/sessions/logout'>Logout<i class='material-icons small right'>lock</i></a>
              </li>
              <?php } else { ?>
              <li>
                <a href='admin/login.html'>Login<i class='material-icons small right'>lock_open</i></a>
              </li><?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div class='container'>
        <div class='row'>
          <div class='col s12 m8' id='_posts'>
            <?php
            while ($post_row = $post_result->fetch_assoc()) {
              $id = $post_row['id'];
              $title = htmlspecialchars_decode($post_row['title'], ENT_QUOTES);
              $content = htmlspecialchars_decode($post_row['content'], ENT_QUOTES);
              $date = $post_row['date'];
            ?>
            <div class='post' id='<?php echo $id; ?>'>
              <h4><a href='ind?id=<?php echo $id; ?>' class='black-text'><?php echo htmlspecialchars_decode($title, ENT_QUOTES); ?></a></h4>
              <small>Posted On: <?php echo $date; ?></small>
              <p><?php echo htmlspecialchars_decode($content, ENT_QUOTES);?></p>
            </div>
            <?php } ?>
          </div>
          <div class='col hide-on-small-only m3 offset-m1 white' id='_sidebar'>
              <h4>About</h4>
              <p><?php echo htmlspecialchars_decode($content_row['about'], ENT_QUOTES); ?><br>
                Contact the Blog Owner: <a href='mailto:<?php echo $content_row['email']; ?>'>
                <?php echo $content_row['email']; ?></a>
              </p>
          </div>
        </div>

      </div>
    </main>

    <footer class='page-footer blue-grey lighten-3'>
      <div class='container'>
        <div class='col s12'>
          <p><?php echo htmlspecialchars_decode($content_row['footer'], ENT_QUOTES); }?></p>
        </div>
      </div>
    </footer>

    <!--Import jQuery before materialize.js-->
    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
    <script type='text/javascript' src='assets/js/materialize.min.js'></script>
    <!--Import custom JS-->
    <script type='text/javascript' src='assets/js/custom.js'></script>
  </body>
</html>
