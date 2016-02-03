<?php
include '../config.php';
include '../sessions/config.php';

$active = check_session();

if ($connect->connect_errno) {
  header('Location: ../../docs.html');
  exit;
}

$content_query = <<<SQL
SELECT *
FROM `content`
SQL;

if(!$content_result = $connect->query($content_query)) {
  die('There was an error fetching content: ' . $connect->error . '. Oops');
}
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset='utf-8' />
     <meta name='author' content='Nate Northway' />
     <title>Footer Editor</title>
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
             <a href='sidebar'>Sidebar Editor<i class='material-icons small right'>border_right</i></a>
           </li>
           <li class='active'>
             <a href='footer'>Footer Editor<i class='material-icons small right'>border_bottom</i></a>
           </li>
           <li>
             <a href='../users/user-admin'>User Administration<i class='material-icons small right'>account_box</i></a>
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
           <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
           <div class='container'>
             <a href='#' class='brand-logo'>Footer Editor</a>
           </div>
         </nav>
     </header>

     <main>
       <div class='container'>
         <div class='row'>
           <div class='error-message col s12 m8 deep-orange' id='error'>
             <h4>There was an error processing your update.</h4>
             <p>Sorry about that. If this problem perists, please check out the <a href='../../docs.html' class='black-text'>docs</a></p>
           </div>
           <div class='error-message col s12 m8 green' id='success'>
             <h4>Your footer has been updated. Click <a href='../../index' class='black-text'>here</a> to see it</h4>
           </div>
           <div class='error-message col s12 m8 deep-orange' id='nocontent'>
             <h4>You submitted your update without content!</h4>
             <p>
               If this happened by mistake, I'm sorry. Send an email to <a href='mailto:nate@natenorthway.com' class='black-text'>
               nate@natenorthway.com</a> describing what happened and I'll try to work with you to fix it.
             </p>
           </div>
         </div>
         <div class='row'>
           <div class='col s12'>
             <?php
             while ($content_row = $content_result->fetch_assoc()) {
               $id = $content_row['id'];
               $footer = htmlspecialchars_decode($content_row['footer'], ENT_QUOTES);
             ?>
             <form action='bin/update-footer?id=<?php echo $id; ?>' method='post'>
               <div class='input-field'>
                 <textarea name='content' id='content' class='materialize-textarea'><?php echo $footer; ?></textarea>
                 <label for='content'>Footer Content</label>
               </div>
               <button name='submit' value='submit' id='submit' class='btn waves-effect waves-light'>Post</button>
             </form>
             <?php } ?>
           </div>
         </div>
       </div>
     </main>

     <footer class='page-footer blue-grey lighten-3'>
       <div class='container'>
         <div class='col s12'>
           <p>Documentation on control center functions can be found in the <a href='../../docs.html#control-center'>docs</a></p>
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
