<?php
include '../config.php';
include '../sessions/config.php';

$active = check_session();

if ($connect->connect_errno) {
  header('Location: ../../docs.html#setup-problems');
  exit;
}

$post_query = <<<SQL
SELECT *
FROM `posts`
ORDER BY `id`
DESC
SQL;

if(!$post_result = $connect->query($post_query)) {
  die('There was an error fetching posts: ' . $connect->error . '. Oops');
}
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset='utf-8' />
     <meta name='author' content='Nate Northway' />
     <title>Post Editor</title>
     <!--Import Google Icon Font-->
     <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
     <!--Import materialize.css-->
     <link type='text/css' rel='stylesheet' href='../../assets/css/materialize.min.css'  media='screen,projection'/>
     <!--Import Custom CSS-->
     <link type='text/css' rel='stylesheet' href='../../assets/css/custom.css' media='all' />

     <!--Let browser know website is optimized for mobile-->
     <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
     <script type='text/javascript'>
       function ConfirmDelete(id) {
         if (confirm('Are you sure you want to delete this post?')) {
           location.href = 'bin/delete-post?id=' + id;
         }
       }
     </script>
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
             <a href='post'>New Post<i class='material-icons small right'>send</i></a>
           </li>
           <li class='active'>
             <a href='post-editor'>Post Editor<i class='material-icons small right'>border_color</i></a>
           </li>
           <li>
             <a href='../content/sidebar'>Sidebar Editor<i class='material-icons small right'>border_right</i></a>
           </li>
           <li>
             <a href='../content/footer'>Footer Editor<i class='material-icons small right'>border_bottom</i></a>
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
             <a href='#' class='brand-logo'>Post Editor</a>
           </div>
         </nav>
         <div id='fab'>
           <a href='post'>
             <button class='btn-floating btn-large waves-effect waves-light'>
               <i class='material-icons'>add</i>
             </button>
           </a>
         </div>
     </header>

     <main>
       <div class='container'>
         <div class='row'>
           <div class='col s12'>
            <div class='card'>
              <div class='card-content'>
                <span class='card-title'>
                  Posts
                </span>
                <table class='bordered'>
                 <thead>
                   <tr>
                     <th id='title'>Title</th>
                     <th id='date'>Date</th>
                     <th id='options'>Options</th>
                   </tr>
                 </thead>
                 <tbody>
                     <?php
                     while ($post_row = $post_result->fetch_assoc()) {
                       ?>
                       <tr>
                         <td>
                           <a href='../../ind?id=<?php echo $post_row['id']?>'>
                             <?php echo $post_row['title']; ?>
                           </a>
                         </td>
                         <td>
                           <?php echo $post_row['date']; ?>
                         </td>
                         <td>
                          <a href='update-post?post_id=<?php echo $post_row['id']; ?>'>
                            <button class='btn waves-effect waves-light'>
                              Update
                            </button>
                          </a>
                          <button class='btn waves-effect waves-light red' onClick='ConfirmDelete("<?php echo $post_row['id']; ?>")'>
                            Delete
                          </button>
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
