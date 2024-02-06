<?php

include "../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();
    $params = $_POST;

    $username = $_POST["username"];
    $password = $params["password"];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["password"] = $row["password"];

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
            <h1>Login Admin</h1>

            <div class="log-in">
                <form method="POST" action="">

                    <label>Username</label>
                    <input required type="text" placeholder="Username" name="username">

                    <label>Password</label>
                    <input required type="password" placeholder="Password" name="password">


                    <button style="cursor: pointer;">Log In</button>
                    <!-- <a href="#">Forgot your password?</a> -->

                </form>
            </div>
        </div>

    </section>
</body>

</html>