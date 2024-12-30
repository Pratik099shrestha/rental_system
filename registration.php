<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.7.1.min"></script>
    <title>Register</title>
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

.form-container {
    background: #1e1e2f;
    padding: 2rem;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    color: #ffffff;
}

.form-container h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #f107a3;
}

form label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #bbb;
}

form input, form textarea, form select {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1.2rem;
    border: none;
    border-radius: 5px;
    background: #2e2e3f;
    color: #fff;
    font-size: 1rem;
}

form input:focus, form textarea:focus, form select:focus {
    outline: 2px solid #f107a3;
}

form button {
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

form button:hover {
    background: #d50691;
}

form span {
    font-size: 0.9rem;
    color: #ff6b6b;
    margin-bottom: 1rem;
    display: block;
}

.form-container p {
    text-align: center;
    margin-top: 1rem;
}

.form-container a {
    color: #f107a3;
    text-decoration: none;
}

.form-container a:hover {
    text-decoration: underline;
}

.validation-message {
    font-size: 0.8rem;
    margin: -10px 0 10px 0;
}

.validation-message.valid {
    color: #00ff00;
}

.validation-message.invalid {
    color: #ff6b6b;
}
#passwordspan{
    color:  #f107a3;
}

@media (max-width: 480px) {
    .form-container {
        padding: 1.5rem;
    }

    .form-container h2 {
        font-size: 1.5rem;
    }
}

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form id="registerForm" action="regDB.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Full Name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter Email" required>
            <span id="emailspan"></span>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Create Username" required>
            <span id="usernamespan"></span>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create New Password" required>

            <span id="passwordspan">
                <p id="upper">Password atleast contaion one upper character</p>
                <p id="lower">Password atleast contaion one lower character</p>
                <p id="symbol">Password atleast contaion one symbol</p>
                <p id="number">Password atleast contaion one number</p>
                <p id="length">Password length must be greater 8 characters</p>

            </span>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>

            <span id="passwordmatch">
                <p id="passwordmatch">Password match failed</p>
            </span>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
            
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3" placeholder="Enter Address" required></textarea>
            
            <label for="ownerType">Owner Type</label>
            <select id="ownerType" name="ownerType" required>
                <option value="individual">Individual</option>
                <option value="agency">Agency</option>
            </select>
            
            <label for="citizenshipNumber">Citizenship Number</label>
            <input type="text" id="citizenshipNumber" name="citizenshipNumber" placeholder="Enter Valid Citizenship Number" required>
            
            <label for="citizenshipCard">Upload Citizenship Card</label>
            <input type="file" id="citizenshipCard" name="citizenshipCard" accept=".jpg, .jpeg, .png, .pdf" >
            
            <button type="submit"><a href="login.php"></a>Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
    <script>
        //password validation
        $(document).ready(function () {
            $("#passwordmatch").hide();
            $("#password").keyup(function () {
                var pass = $("#password").val();
    
                // Check for at least one uppercase letter
                if (pass.search(/[A-Z]/) >= 0) {
                    $("#upper").hide();
                } else {
                    $("#upper").show();
                }
    
                // Check for at least one lowercase letter
                if (pass.search(/[a-z]/) >= 0) {
                    $("#lower").hide();
                } else {
                    $("#lower").show();
                }
    
                // Check for at least one special symbol
                if (pass.search(/[!@#$%^&*(),.?":{}|<>]/) >= 0) {
                    $("#symbol").hide();
                } else {
                    $("#symbol").show();
                }
    
                // Check for at least one digit
                if (pass.search(/[0-9]/) >= 0) {
                    $("#number").hide();
                } else {
                    $("#number").show();
                }
                if (pass.length>8){
                    $("#length").hide();
                }
                else{
                    $("#length").show();
                }

            //confirm password validation
            $("#confirmpassword").keyup(function(){
            var matchpassword = $("#confirmpassword").val();
            if (matchpassword != pass){
                $("#passwordmatch").show().css('color', 'red');
            }
            else{
                $("#passwordmatch").hide();
            }
        }),
        $('#email').keyup(()=>{
            var email=$("#email").val();
            if (email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        $("#emailspan").html("");
      } else {
        $("#emailspan").html("Invalid Email Format!").css("color", "red");
      } 
        })
        });

        $(document).ready(
            $("#username").keyup(function(){
                var uname = $("#username").val();
                $("#usernamespan").css('marginLeft', '20%');
                if(uname.length<8 || uname.length>25){
                    $("#username").css('color', 'red');
                    $("#usernamespan").html("Username must be of 8 characters").css('color', 'red');
                }
                else{
                    $("#username").css('color', ' #f107a3');
                    $("#usernamespan").hide();
                }
            })
        );

        });
    </script>
</body>
</html>
