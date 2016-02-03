<?php
include '../config.php';
include '../sessions/config.php';

unset($content_row);
unset($content_result);

$active = check_session();

if ($connect->connect_errno) {
  header('Location: ../../docs.html#setup-problems');
  exit;
}

$user_query = <<<SQL
SELECT *
FROM `users`
ORDER BY `id`
SQL;


if(!$user_result = $connect->query($user_query)) {
  die('There was an error fetching content: ' . $connect->error . '. Oops');
}

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset='utf-8' />
     <meta name='author' content='Nate Northway' />
     <title>User Administration</title>
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
           <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
           <div class='container'>
             <a href='#' class='brand-logo'>User Administration</a>
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
             <h4>Your update has processed.</h4>
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
             <div class='card'>
               <div class='card-content'>
                 <span class='card-title'>
                   Users
                 </span>
                 <table>
                   <thead>
                     <th data-field='id'>
                       ID
                     </th>
                     <th data-field='username'>
                       Username
                     </th>
                     <th data-field='email'>
                       Email
                     </th>
                   </thead>
                   <tbody>
                     <?php
                     while ($user_row = $user_result->fetch_assoc()) {
                      ?>
                     <tr>
                       <td>
                         <?php echo $user_row['id']; ?>
                       </td>
                       <td>
                         <?php echo $user_row['username']; ?>
                       </td>
                       <td>
                         <?php echo $user_row['email']; ?>
                       </td>
                       <td>
                         <a href='update-user?id=<?php echo $user_row['id']; ?>'>
                           <button name='submit' value='submit' class='btn waves-effect waves-light'>Edit</button>
                         </a>
                       </td>
                     </tr>
                     <?php } ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div id='fab'>
         <a href='add-user?s=false'>
           <button class='btn-floating btn-large waves-effect waves-light'>
             <i class='material-icons'>add</i>
           </button>
         </a>
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
