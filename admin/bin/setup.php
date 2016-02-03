<?php
//all the form info
$blog_url = $_POST['blog_url'];
$host = $_POST['host_url'];
$db_name = $_POST['db_name'];
$db_user = $_POST['db_user'];
$db_pass = $_POST['db_pass'];
$blog_user = $_POST['blog_user'];
$blog_pass = md5($_POST['blog_pass']);
$user_email = $_POST['blog_email'];
$blog_name = $_POST['blog_name'];
$blog_description = $_POST['blog_desc'];
$footer_text = $_POST['footer_text'];
$date = date('Y-m-d');

$blog_name = htmlspecialchars($blog_name, ENT_QUOTES);
$blog_description = htmlspecialchars($blog_description, ENT_QUOTES);
$footer_text = htmlspecialchars($footer_text, ENT_QUOTES);

unlink('../config.php');

$config_info = "<?php
/*
  Streampost Configuration file
*/

\$not_setup = false;
\$host = '" . $host . "';
\$db_name = '" . $db_name . "';
\$db_user = '" . $db_user . "';
\$db_pass = '" . $db_pass . "';
\$db_url = '" . $blog_url . "';
\$index_url = '" . $blog_url . "/index.php';
\$connect = new mysqli('" . $host . "','" . $db_user . "','" . $db_pass . "','" . $db_name . "');
\$connect1 = mysqli_connect('" . $host . "', '" . $db_user . "', '" . $db_pass . "','" . $db_name . "');
\$contact = '" . $user_email . "';
 ?>";

file_put_contents('../config.php', $config_info);

$connection = new mysqli($host,$db_user,$db_pass,$db_name);

  //create the table for 'content'
$create_content = "CREATE TABLE content (id INT NOT NULL AUTO_INCREMENT, header LONGTEXT, footer LONGTEXT, about LONGTEXT, email VARCHAR(50), PRIMARY KEY (`id`));";

//execute previous query
$connection->query($create_content);

//fill the content table
$fill_content = "INSERT INTO `content` (`id`, `header`, `footer`, `about`, `email`) VALUES (NULL, '$blog_name', '$footer_text', '$blog_description', '$user_email');";

//execute previous query
$connection->query($fill_content);

//create the table for 'posts'
$create_posts = "CREATE TABLE posts (id INT NOT NULL AUTO_INCREMENT, post_id LONGTEXT, title LONGTEXT, content LONGTEXT, date DATE, PRIMARY KEY (`id`));";

//execute previous query
$connection->query($create_posts);

$post_id = 'Welcome to Streampost!';

//fill the posts table with the first post
$fill_posts = "INSERT INTO `posts` (`id`, `post_id`, `title`, `content`, `date`) VALUES (NULL, 'Welcome to Streampost', 'Welcome to Streampost', 'This is your first Streampost Post. To get some help, head to the <a href=&#39;docs.html&#39;>Documentation</a> to learn more about Streampost. Happy Blogging!', '$date');";
//execute previous query
$connection->query($fill_posts);

//create the table for 'users'
$create_users = "CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, username LONGTEXT, password LONGTEXT, email VARCHAR(50), PRIMARY KEY (`id`));";

//execute previous query
$connection->query($create_users);

//fill the users table
$fill_users = "INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, '$blog_user', '$blog_pass', '$user_email');";

//execute previous query
$connection->query($fill_users);

//if there is an error connecting, redirect back to the form and show the error
if ($connection->connect_errno) {
  header('Location: ../../setup.html#setup_error');
  exit;
}


//send an email on blog creation
$msg = "
Hello, there!
Congratulations! You're now among the dozens of Streampost Users!
Your blog is now live at http://" . $blog_url . "

To sign in, follow this link:
http://" . $blog_url . "/admin/login.html

If you're uncertain of anything regarding your Streampost blog, be sure to check out the docs here:
http://" . $blog_url . "/docs.html

Thanks for using Streampost!

-Nate Northway, developer of Streampost
";

$message = wordwrap($msg, 70, "\r\n");

$replyto = 'nate@natenorthway.com';
$headers = "From: new-install@" . $index_url . " " . "\r\n" .
"Reply-To: nate@natenorthway.com" . "\r\n" .
"X-Mailer: PHP/" . phpversion();

mail($user_email, 'Welcome to Streampost', $message, $headers);

if (isset($_POST['submit'])) header('Location: ../../index');
?>
