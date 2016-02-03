<?php
  include '../config.php';
  include '../sessions/config.php';

  $active = check_session();

  $id = $_GET['post_id'];

  if (!$active) {
    header('Location: ../login.html');
    exit;
  }

$query = <<<SQL
SELECT *
FROM `posts`
WHERE `id`
= $id
SQL;

if(!$post_result = $connect->query($query)) {
  die('There was an error fetching posts: ' . $connect->error . '. Oops');
}

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
                   <i class='material-icons small center'>lock_open</i>
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
           <a href='#' data-activates='slide-out' class='button-collapse'><i class='mdi-navigation-menu'></i></a>
           <div class='container'>
             <a href='#' class='brand-logo'>Update Post</a>
           </div>
         </nav>
     </header>

     <main>
       <div class='container'>
         <div class='row'>
           <div class='error-message col s12 m8 deep-orange' id='error'>
             <h4>There was an error processing your post.</h4>
             <p>Sorry about that. If this problem perists, please check out the <a href='../../docs.html' class='black-text'>docs</a></p>
           </div>
           <div class='error-message col s12 m8 green' id='success'>
             <h4>Your entry has been updated. Click <a href='../../index' class='black-text'>here</a> to see it</h4>
           </div>
           <div class='error-message col s12 m8 deep-orange' id='nocontent'>
             <h4>You submitted your post without a title or content</h4>
             <p>
               If this happened by mistake, I'm sorry. Send an email to <a href='mailto:nate@natenorthway.com' class='black-text'>
               nate@natenorthway.com</a> describing what happened and I'll try to work with you to fix it.
             </p>
           </div>
         </div>
         <div class='row'>
           <div class='col s12 m8' id='_post-form'>
             <?php
             while ($post_row = $post_result->fetch_assoc()) {
               $title = htmlspecialchars_decode($post_row['title'], ENT_QUOTES);
               $content = htmlspecialchars_decode($post_row['content'], ENT_QUOTES);
             ?>
             <form action='bin/updatepost?id=<?php echo $id; ?>' method='post'>
               <div class='input-field'>
                 <input type='text' name='title' id='title' value='<?php echo $title; ?>' />
                 <label for='title'>Post Title</label>
               </div>
               <div class='input-field'>
                 <textarea name='content' id='content' class='materialize-textarea'><?php echo $content; ?></textarea>
                 <label for='content'>Post Content</label>
               </div>
               <button name='submit' value='submit' id='submit' class='btn waves-effect waves-light'>Post</button>
             </form>
             <?php } ?>
           </div>
           <div class='col hide-on-small-only m3 offset-m1 white' id='_sidebar'>
             <ul>
               <li>When creating a post, remember that your post's URL will include the title</li>
               <li>You can include HTML markup in the post</li>
               <li>To learn more about HTML markup in posts, check out the <a href='../../docs.html#html'>docs</a></li>
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
