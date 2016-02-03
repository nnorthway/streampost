<?php
//all the form info
$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$post_id = htmlspecialchars($title, ENT_QUOTES);
$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
$date = date('Y-m-d');

unset($content_result);
unset($content_row);

include '../config.php';
include '../sessions/config.php';

$active = check_session();

if (isset($_POST['preview'])) {

  if ($connect->connect_errno) {
    header('Location: ../../docs.html#setup-problems');
    exit;
  }
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset='utf-8' />
      <meta name='author' content='Nate Northway' />
      <title>Post preview</title>
      <!--Import Google Icon Font-->
      <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
      <!--Import materialize.css-->
      <link type='text/css' rel='stylesheet' href='../../assets/css/materialize.min.css'  media='screen,projection'/>
      <!--Import Custom CSS-->
      <link type='text/css' rel='stylesheet' href='../../assets/css/custom.css' media='all' />

      <!--Let browser know website is optimized for mobile-->
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    </head>
    <body class='grey lighten-5'>
      <header>
        <nav>
          <div class='nav-wrapper blue-grey'>
            <div class='container'>
              <a href='#' class='brand-logo'>Post Preview</a>
              <ul class='right'>
                <li>
                  <a href='../../index'>Back to Home<i class='material-icons small right'>home</i></a>
                </li>
                <li>
                  <a href='../index'>Control Center<i class='material-icons small right'>web</i></a>
                </li>
                <li>
                  <a href='../sessions/logout'>Logout<i class='material-icons small right'>lock</i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <main>
        <div class='container'>
          <div class='row'>
            <div class='col s12 m8' id='_posts'>
              <div class='post' id='<?php echo $title; ?>'>
                <h4><a href='../../ind?id=<?php echo $title; ?>' class='black-text'><?php echo htmlspecialchars_decode($title, ENT_QUOTES); ?></a></h4>
                <small>Posted On: <?php echo $date; ?></small>
                <p><?php echo htmlspecialchars_decode($content, ENT_QUOTES);?></p>
              </div>
            </div>
            <div class='col s12 m3 offset-m1 white' id='_sidebar'>
                <h4>About Preview</h4>
                <p>
                  This is your post preview. To submit this post, press 'submit' below
                </p>
                <form action='newpost.php' method='post'>
                  <input class='hide' name='title' value='<?php echo htmlspecialchars_decode($title, ENT_QUOTES); ?>' />
                  <textarea class='hide' name='content'><?php echo htmlspecialchars_decode($content, ENT_QUOTES); ?></textarea>
                  <button name='submit' type='submit' value='submit' class='waves-effect waves-light btn btm-room'>Submit</button>
                </form>
            </div>
          </div>

        </div>
      </main>

      <footer class='page-footer blue-grey lighten-3'>
        <div class='container'>
          <div class='col s12'>
            <p>Everything you need to know can be found in the <a href='../../docs.html'>Docs</a></p>
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



  <?php
} else {

  if ($connect->connect_errno) {
    header('Location: post#error');
    exit;
  }

  if ($title == '') {
    header('Location: post#nocontent');
    exit;
  }
  $fill = "INSERT INTO `posts` (`id`, `post_id`, `title`, `content`, `date`) VALUES (NULL, '$post_id', '$title', '$content', '$date')";

  $connect->query($fill);

  header('Location: post#success');
  exit;
}
 ?>
