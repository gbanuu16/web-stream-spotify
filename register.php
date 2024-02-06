<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();
    $params = $_POST;

    if ($params['password'] != $params['password2']) {
        echo "<script>alert('Password & Confirm Password should be match!'); location.href = 'register.php';</script>";
    }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $params["password"];

    $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('Username or Email already exists, choose the other one'); location.href = 'register.php';</script>";
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Sign up success, you can log in now'); location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Error occured please try again later'); location.href = 'register.php';</script>";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Register Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="./images/Spotify_favicon.png" type="image/x-icon">
</head>

<body>

    <header>
        <div class="logo">
            <a href="index.php">
                <img src="img/spo-logo.png">
            </a>
        </div>
    </header>



    <section>

        <div class="main">
            <h1>Sign up to Spotify</h1>

            <!-- <div class="account-connect">
                <button class="a-c-btn" id="g"><img src="img/google.png"><span>Continue with Google</span></button>
                <button class="a-c-btn" id="g"><img src="img/facebook.png"><span>Continue with Facebook</span></button>
                <button class="a-c-btn" id="g"><img src="img/apple.png"><span>Continue with Apple</span></button>
                <button class="a-c-btn" id="g"><span>Continue with phone number</span></button>
            </div>

            <hr> -->

            <div class="log-in">
                <form method="POST" action="">

                    <label>Username</label>
                    <input required type="text" placeholder="Username" name="username">

                    <label>Email</label>
                    <input required type="text" placeholder="Email" name="email">

                    <label>Password</label>
                    <input required type="password" placeholder="Password" name="password">

                    <label>Confirm Password</label>
                    <input required type="password" placeholder="Confirm Password" name="password2">

                    <!-- <div class="switch">
                        <input type="checkbox" id="switch" checked>
                        <label for="switch"></label>
                        <span>Remember me</span>
                    </div> -->

                    <button style="cursor: pointer;">Sign Up</button>


                    <!-- <a href="#">Forgot your password?</a> -->

                </form>
            </div>


            <hr>

            <div class="last">
                <span>Already have an account?</span>
                <a href="login.php">Log in for Spotify</a>
            </div>






        </div>

    </section>



</body>

</html>