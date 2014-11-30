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
 
<!--  show the title automatically -->
<?php include('./includes/title.inc.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Project Management Platform<?php if(isset($title)) {echo "&#8212;$title";} ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <?php include('./includes/header.inc.php'); ?>
    
<!-- the login table -->
    <div id="login_form">
        <div id="login_header"><h3>Sign In</h3></div>
        <div id="login_body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label><b>Username</b></label><br>
                <input name="username" type="text" autofocus="autofocus"><br><br>
                <label><b>Password</b></label><br>
                <input name="password" type="password"><br><br>
                <input name="login" type="submit" value="Sign in"><?php echo "$error"; ?><br><br>
            </form>
        </div>
     </div>  
      
    <?php include('./includes/footer.inc.php'); ?>

</body>
</html>