<?php
include("./session.php");

session_start();
$cname="";
if(!isset($_SESSION['email'])){
    header("Location: login.php");
}else{
    $cname=$_SESSION['email'];
}
include("navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome Home</h1>
    <p>Session:<?php echo $cname; ?></p>
    Cookie: <?php echo $_COOKIE['email'];?>
    <a href="logout.php">LogOut</a>
</body>
</html>