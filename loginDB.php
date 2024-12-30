<?php
include("./session.php");

session_start();
if(isset($_SESSION['email'])){
    header("Location: home.php");
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_project"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c=$_POST['choosen'];

    // Query to check if the user exists and retrieve their name and password
    $sql = "SELECT name, password FROM owners WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch user details
        $stmt->bind_result($name, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            if($c==true){
                $_SESSION["email"]= $email;
                $_SESSION["password"]=$password;
                setcookie('email', $email, time()+86400, '/',secure:true);
            }
            else{
                $_SESSION["email"]= $email;
                $_SESSION["password"]=$password;
                setcookie('email', $email, time()-86400, '/',secure:true);
            }
            
        } else {
        header("Location:login.php?error=Invalid Password");
        }
    } else {
        header("Location:login.php?error=Invalid Email");
    }

   
    $stmt->close();
}

$conn->close();

// $e=$_POST['email'];
// $p=$_POST['password'];
// $c=$_POST['choosen'];

// $res = mysqli_query($con, "SELECT * FROM owners WHERE email='$e' AND password='$p'");
// if(mysqli_num_rows($res)>0){
//     if($c=="true"){
//         $_SESSION['email']=$e;
//         $_SESSION['password']=$p;
//         setcookie('email', $e, time()+86400, '/',secure:true);
//     }
//     else{
//         $_SESSION['email']=$e;
//         $_SESSION['password']=$p;
//         setcookie('email',$e,time()- 86400,'/',secure:true);
//     }
// }
?>