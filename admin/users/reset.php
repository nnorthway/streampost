<?php
$forgot = $_GET['f'];
$u;
$p;
if ($forgot == 'username') {
  $u = true;
  $p = false;
} else {
  $u = false;
  $p = true;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <meta name='author' content='Nate Northway' />
    <title>Forgotten <?php if ($u) { ?>Username<?php } else { ?>Password<?php } ?> | Streampost</title>
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
            <a href='#' class='brand-logo'>Forgotten <?php if ($u) { ?>Username<?php } else {?>Password<?php } ?></a>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div class='container'>
        <div class='row'>
          <div class='col s12 m8 offset-m2'>
            <p class='flow-text'>
              Hey! You forgot your <?php if ($u) {?> username <?php } else { ?> password <?php } ?>. No biggie!
              Just fill out the form and we'll <?php if ($u) {?> email you your username. <?php } else {?> reset your
              password and send you an email. <?php } ?>
            </p>
            <?php if ($u) { ?>
              <form action='forgotten_username' method='post'>
            <?php } else { ?>
              <form action='forgotten_password' method='post'>
            <?php } ?>
                <div class='input-field'>
                  <input type='email' name='i_email' id='i_email' placeholder='name@example.com' />
                  <label for='i_email'>Your Email</label>
                </div>
              <button name='submit' value='submit' type='submit' class='btn waves-effect waves-light'>Submit</button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <footer class='page-footer blue-grey lighten-3'>
      <div class='container'>
        <div class='col s12'>
          <p>Wanna know a secret? All of your answers exist in the <a href='../../docs.html'>docs</a></p>
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
