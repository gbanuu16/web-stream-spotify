<?php

include "../config.php";
error_reporting(0);
session_start();

$id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;
$selected_data = [];

if ($id) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $playlist = [];
    $playlist2 = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selected_data = $row;
        }
    }
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();
    $params = $_POST;

    $id = $params['id'];
    $username = $params["username"];
    $email = $params["email"];
    $password = $params['password'];
    $avatar = $_FILES['avatar'];

    if ($id > 0) {
        $update_file = '';

        if ($_FILES["avatar"]["tmp_name"]) {
            $targetDir = "../images/profile-pics/";
            $file = basename($_FILES["avatar"]["name"]);
            $targetFile = $targetDir . basename($file);
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
            $avatar = basename($file);
            $update_file .= " , avatar = '" . $avatar . "' ";
        }

        $sql = "UPDATE users SET username = '$username', email = '$email', password = '$password' $update_file WHERE id = '$id'";
    } else {
        $targetDir = "../images/profile-pics/";
        $file = basename($_FILES["avatar"]["name"]);
        $targetFile = $targetDir . basename($file);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
        $avatar = basename($file);

        $sql = "INSERT INTO users (username, email, password, avatar) VALUES ('$username', '$email', '$password', '$avatar')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User succesfully saved'); location.href = 'users.php';</script>";
    } else {
        echo "<script>alert('Error occured please try again later'); location.href = 'users.php';</script>";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="pemutar_musik.css">
    <link rel="shortcut icon" href="./images/Spotify_favicon.png" type="image/x-icon">

    <style>
        .input {
            display: block;
            padding: 14px;
            width: 60%;
            margin-bottom: 15px;
            font-size: 15px;
            font-weight: 500;
            background: rgb(18, 18, 18);
            outline: none;
            border: none;
            appearance: none;
            border-radius: 4px;
            box-shadow: inset 0 0 0 1px #878787;
            color: white;
        }

        table td {
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo">
            <a href="">
                <img src="./images/Spotify Logo.png" alt="Logo">
            </a>
        </div>

        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="fa fa-music"></span>
                        <span>Playlist</span>
                    </a>
                </li>
                <li>
                    <a href="category.php">
                        <span class="fa fa-list"></span>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <span class="fa fas fa-users"></span>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php">
                        <span class="fa fas fa-user"></span>
                        <span>Admin</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="fa fa-home"></span>
                        <span>Create Playlist</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-search"></span>
                        <span>Liked Songs</span>
                    </a>
                </li>

            </ul>
        </div> -->

        <div class="policies">
            <ul>
                <li>
                    <a href="">Cookies</a>
                </li>
                <li>
                    <a href="">Privacy</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-container">
        <div class="topbar">
            <div class="prev-next-buttons">
                <button type="button" class="fa fas fa-chevron-left"></button>
                <button type="button" class="fa fas fa-chevron-right"></button>
            </div>

            <div class="navbar">
                <a href="logout.php"><button type="button">Logout</button></a>
            </div>
        </div>

        <div class="spotify-playlists">
            <h2>Add / Edit Users</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />

                <label style="color: white; font-size: 15px;">Username</label>
                <input required type="text" class="input" name="username" placeholder="" value="<?php echo $selected_data['username']; ?>">

                <label style="color: white; font-size: 15px;">Email</label>
                <input required type="text" class="input" name="email" placeholder="" value="<?php echo $selected_data['email']; ?>">

                <label style="color: white; font-size: 15px;">Password</label>
                <input required type="password" class="input" name="password" placeholder="" value="<?php echo $selected_data['password']; ?>">

                <label style="color: white; font-size: 15px;">Avatar <?php if ($id) {
                                                                            echo "(Abaikan apabila tidak ingin diganti)";
                                                                        } ?></label>
                <input <?php if (empty($id)) {
                            echo "required";
                        } ?> type="file" class="input" name="avatar" placeholder="">

                <button style="padding: 10px; background: white; color: black; font-weight: 900; font-size: 15px; width: 60%; margin-bottom: 10px;">Save</button>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ef9a692198.js" crossorigin="anonymous"></script>
</body>

</html>