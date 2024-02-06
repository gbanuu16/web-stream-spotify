<?php

include "../config.php";
error_reporting(0);
session_start();

$conn = connectToDatabase();
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);
$playlist = [];
$playlist2 = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $playlist[] = $row['audio'];
        $playlist2[] = $row;
    }
}
$conn->close();

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
            width: 100%;
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
            <h2>Users</h2>
            <a href="users_edit.php"><button style="padding: 10px; background: white; color: black; font-weight: 900; font-size: 15px; margin-bottom: 10px;">Add New User</button></a>
            <div class="list">
                <table style="width: 100%; color: white;" border="1">
                    <tr style="background: white; color: black !important; font-weight: 900; font-size: 15px;">
                        <td>#</td>
                        <td>Avatar</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>

                    <?php
                    $conn = connectToDatabase();
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {  ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><img style="width: 100px; height: 100px; object-fit: cover;" src="../images/profile-pics/<?php echo $row['avatar']; ?>" /></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <a href="users_edit.php?id=<?php echo $row['id']; ?>" style="background: #222222; color: white; border: 1px solid white; padding: 10px;"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                    <a href="users_delete.php?id=<?php echo $row['id']; ?>" style="background: #222222; color: red; border: 1px solid red; padding: 10px;"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                    <?php }
                    }
                    $conn->close(); ?>

                </table>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ef9a692198.js" crossorigin="anonymous"></script>
</body>

</html>