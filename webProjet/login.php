<?php include('./includes/title.inc.php'); ?>
<?php ini_set('display_erros', '1'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Project Management Platform<?php if(isset($title)) {echo "&#8212;$title";} ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $valid_username = "abc";
    $valid_password = "abc";
    $input_correct = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // if(empty($_POST["username"]) || empty($_POST["password"])) {
        //     $input_username = "Please input your username and password.";
        // } else {
        //     if($_POST["username"] != "abc") {
        //         $input_correct = "username or password incorrect!";
        //     }
        // }
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];
        if($input_username == $valid_username && $input_password == $valid_password) {
            header('Location: login.php');
            exit();
        } else {
            $input_correct = "The username or password is not correct.";
        }
    }
    ?>

    <?php include('./includes/header.inc.php'); ?>
    <div id="login_form">
        <div id="login_header"><h3>Sign In</h3></div>
        <div id="login_body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label><b>Username</b></label><br>
                <input name="username" type="text" autofocus="autofocus"><br><br>
                <label><b>Password</b></label><br>
                <input name="password" type="password"><br><br>
                <input name="commit" type="submit" value="Sign in"><?php echo "$input_correct"; ?><br><br>
            </form>
        </div>
     </div>   
    <?php include('./includes/footer.inc.php'); ?>

</body>
</html>