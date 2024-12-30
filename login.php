<?php
session_start();
include("./session.php");

if(isset(($_SESSION["email"]))){
    header("Location: home.php");
}
$cname="";
if(isset($_COOKIE["email"])){
    $cname=$_COOKIE["email"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="jquery-3.7.1.min"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #7b2ff7, #f107a3);
            color: #ffffff;
        }

        .login-container {
            background: #1e1e2f;
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #f107a3;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #bbb;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background: #2e2e3f;
            color: #fff;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: 2px solid #f107a3;
        }

        .remember-me {
            font-size: 0.9rem;
            color: #bbb;
            margin-top: 1rem;
            margin-bottom: 1rem;
            display: flex;
        }

        .remember-me input {
            accent-color: #f107a3;
            width: auto;
            margin-right: 10px;
        }

        .login-btn {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background: #f107a3;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #d50691;
        }

        .forgot-password, .signup-link {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password a, .signup-link a {
            color: #f107a3;
            text-decoration: none;
        }

        .forgot-password a:hover, .signup-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .login-container h1 {
                font-size: 1.5rem;
            }

            .form-group input {
                font-size: 0.9rem;
            }
        }
        
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <input type="button" value="Login" id="loginBtn" class="login-btn" name="loginBtn">
            <span id="databaseMsg" style="color:  #f107a3;"></span>
            <div class="forgot-password">
            <a href="forgetPassword.php">Forgot password?</a>
        </div>
        <div class="signup-link">
            <p>Don't have an account? <a href="registration.php">Sign up</a></p>
        </div>
    </form>
        
    </div>
    <script>
        $(document).ready($("#loginBtn").click(function(){
            var cname="<?php echo $cname; ?>";
            if(cname){
                $("#remember").prop('checked', true);
            }

            var email = $("#email").val();
            var pass = $("#password").val();
            var choosen;
            if($("#remember").is(":checked")){
                choosen=true;
            }
            else{
                choosen=false;
            }
            $.ajax({
                url: "loginDB.php",
                method: "POST",
                data: {email, password: pass, choosen},
                // success:function(msg){
                //     $("#databaseMsg").html(msg);
                // }
                success:function(){
                    window.location.assign("home.php");
                }
            })
        }))
    </script>
</body>
</html>
