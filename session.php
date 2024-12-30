<?php
if(isset($_SESSION['email'])){
    header("Location: home.php");
}
$con=mysqli_connect("localhost", "root", "", "rental_project");
if(!$con){
   echo "Database Error";
}
?>