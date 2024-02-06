<?php

include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();
    $params = $_POST;

    $username = $_POST["username"];
    $password = $params["password"];

    $sql = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["avatar"] = $row["avatar"];

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Credential invalid, please try again'); location.href = 'login.php';</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Log in Page</title>
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
            <h1>Log in to Spotify</h1>

            <div class="account-connect">
                <button class="a-c-btn" id="g"><img src="img/google.png"><span>Continue with Google</span></button>
                <button class="a-c-btn" id="g"><img src="img/facebook.png"><span>Continue with Facebook</span></button>
                <button class="a-c-btn" id="g"><img src="img/apple.png"><span>Continue with Apple</span></button>
                <button class="a-c-btn" id="g"><span>Continue with phone number</span></button>
            </div>

            <hr>


            <div class="log-in">
                <form method="POST" action="">

                    <label>Email or username</label>
                    <input required type="text" placeholder="Email or username" name="username">

                    <label>Password</label>
                    <input required type="password" placeholder="Password" name="password">


                    <div class="switch">
                        <input type="checkbox" id="switch" checked>
                        <label for="switch"></label>
                        <span>Remember me</span>
                    </div>

                    <button style="cursor: pointer;">Log In</button>
                    <!-- <a href="#">Forgot your password?</a> -->

                </form>
            </div>


            <hr>

            <div class="last">
                <span>Don't you have an account?</span>
                <a href="register.php">Sign up for Spotify</a>
            </div>
        </div>

    </section>
</body>

</html>