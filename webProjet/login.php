<?php
// connect the database and verify username and password
        $error = '';
        if(isset($_POST['login'])) {
            session_start();
            $username = $_POST['username'];
            $password = $_POST['password'];
            require_once 'includes/authenticate.inc.php';
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login | Project Management Platform</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include 'includes/statebar.inc.php';?>
    <?php include('includes/header.inc.php'); ?>
    
<!-- the login table -->
    <div id="login_form_container">
        <div><h3 id="login_header">Sign In</h3></div>
        <div id="login_body">
            <form id="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label><b>Username</b></label><br>
                <input name="username" type="text" autofocus="autofocus"><br><br>
                <label><b>Password</b></label><br>
                <input name="password" type="password"><br><br>
                <input name="login" type="submit" value="Sign in"><?php echo "<span id=\"input_validity\">$error</span>"; ?><br><br>
            </form>
        </div>
     </div>  
      
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>