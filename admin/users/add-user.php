<?php
include '../config.php';
include '../sessions/config.php';

$active = check_session();

if (!$active) {
  header('Location: ../login.html');
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <meta name='author' content='Nate Northway' />
    <title>Add User</title>
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
            <a href='../index'>Blog Home<i class='material-icons small right'>home</i></a>
          </li>
          <li>
            <a href='../sessions/logout'>Logout<i class='material-icons small right'>lock</i></a>
          </li>
          <li>
            <a href='../../docs.html'>Docs/Help<i class='material-icons small right'>info</i></a>
          </li>
        </ul>
        <nav class='blue-grey hide-on-large-only'>
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
          <div class='container'>
            <a href='#' class='brand-logo'>New Post</a>
          </div>
        </nav>
    </header>

    <main>
      <div class='container'>
          <div class='row'>
            <div class='green error-message col s12' id='success'>
              <h4>User Added!</h4>
            </div>
            <div class='deep-orange error-message col s12' id='error'>
              <h4>There was an error processing your request</h4>
              <p>Please try again. If you believe this happened in error, I'm sorry, please
                <a href='mailto:nate@natenorthway.com'>email me</a> and I can try to work
                out the issue with you.
              </p>
            </div>
            <div class='deep-orange error-message col s12' id='empty'>
              <h4>Oops! You submitted the form with missing information!</h4>
              <p>It's OKAY, just give it another shot there, bud!</p>
            </div>
          </div>
        <div class='row'>
          <div class='col s12 m8' id='_post-form'>
            <form action='bin/adduser' method='post'>
              <div class='input-field'>
                <input type='text' name='username' id='username' placeholder='Username' />
                <label for='title'>Username</label>
              </div>
              <div class='input-field'>
                <input type='password' name='password' id='password' placeholder='********' />
                <label for='password'>Password</label>
              </div>
              <div class='input-field'>
                <input type='email' name='email' id='email' placeholder='me@example.com' />
                <label for='email'>Email</label>
              </div>
              <button name='submit' value='submit' id='submit' class='btn waves-effect waves-light'>Submit</button>
            </form>
          </div>
          <div class='col hide-on-small-only m3 offset-m1 white' id='_sidebar'>
            <ul>
              <li>When choosing a username, choose something unique: names like 'admin' or 'user' are insecure</li>
              <li>Your password should contain upper and lowercase letters, numbers, and special characters such as !@#$%^&amp;*()/><</li>
            </ul>
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
    <script type='text/javascript' src='../../assets/js/materialize.min.js'></script>
    <!--Import custom JS-->
    <script type='text/javascript' src='../../assets/js/custom.js'></script>
  </body>
</html>
