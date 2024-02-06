<?php

include "config.php";
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
                        <span class="fa fa-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="search.php">
                        <span class="fa fa-search"></span>
                        <span>Search</span>
                    </a>
                </li>
                <li>
                    <a href="library.php">
                        <span class="fa fas fa-book"></span>
                        <span>Your Library</span>
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
                <?php if (empty($_SESSION['user_id'])) { ?>
                    <ul>
                        <li>
                            <a href="register.php">Sign Up</a>
                        </li>
                    </ul>
                    <a href="login.php"><button type="button">Login</button></a>
                <?php } else { ?>
                    <ul>
                        <li>
                            <a href="profile.php">Profile</a>
                        </li>
                    </ul>
                    <a href="logout.php"><button type="button">Logout</button></a>
                <?php } ?>
            </div>
        </div>

        <div class="spotify-playlists">
            <h2>Search</h2>
            <form method="GET" action="">
                <input type="text" class="input" name="search" placeholder="Search the title music or artist name here..." value="<?php echo $_REQUEST['search']; ?>">
            </form>

            <div class="list">
                <?php
                $search = $_REQUEST['search'];
                if ($search) {
                    $conn = connectToDatabase();
                    $sql = "SELECT * FROM songs WHERE title LIKE '%" . $search . "%' OR artist LIKE '%" . $search . "%' ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="item">';
                            echo '<img src="./images/' . $row['image'] . '" />';
                            echo '<div onclick="playAudio(\'' . $row['id'] . '\')" class="play">';
                            echo '<span class="fa fa-play"></span>';
                            echo '</div>';
                            echo '<h4>' . $row['title'] . '</h4>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo "";
                    }
                    $conn->close();
                } else {
                    $conn = connectToDatabase();
                    $sql = "SELECT * FROM songs LIMIT 8";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="item">';
                            echo '<img src="./images/' . $row['image'] . '" />';
                            echo '<div onclick="playAudio(\'' . $row['id'] . '\')" class="play">';
                            echo '<span class="fa fa-play"></span>';
                            echo '</div>';
                            echo '<h4>' . $row['title'] . '</h4>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo "";
                    }
                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ef9a692198.js" crossorigin="anonymous"></script>
</body>

</html>

<div class="music-player">
    <div class="song-bar">
        <div class="song-infos">
            <div class="image-container">
                <img src="./images/today-hit.jpg" alt="">
            </div>
            <div class="song-description">
                <p class="title">Today's Top Hits</p>
                <p class="artist">Olivia Rodrigo</p>
            </div>
        </div>
        <div class="icons">
            <i class="far fa-heart"></i>
            <i class="fas fa-compress"></i>
        </div>
    </div>
    <div class="progress-controller">
        <div class="control-buttons">
            <i class="fas fa-random"></i>
            <i class="fas fa-step-backward"></i>
            <i class="play-pause fas fa-play"></i>
            <i class="fas fa-step-forward"></i>
            <i class="fas fa-undo-alt"></i>
        </div>
        <div class="progress-container">
            <span class="current-time">0:00</span>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <span class="duration">0:00</span>
        </div>
    </div>
    <div class="other-features">
        <i class="fas fa-list-ul"></i>
        <i class="fas fa-desktop"></i>
        <div class="volume-bar">
            <i class="fas fa-volume-down"></i>
            <div class="progress-bar">
                <div class="progress2"></div>
            </div>
        </div>
    </div>
</div>

<audio id="audioPlayer" src="audio/coffee.mp3"></audio>

<script>
    const audioPlayer = document.getElementById('audioPlayer');
    const playPauseButton = document.querySelector('.play-pause');
    const progress = document.querySelector('.progress');
    const currentTime = document.querySelector('.current-time');
    const duration = document.querySelector('.duration');
    const volumeBar = document.querySelector('.volume-bar .progress2');
    const volumeDownIcon = document.querySelector('.volume-bar i.fa-volume-down');

    playPauseButton.addEventListener('click', togglePlayPause);
    audioPlayer.addEventListener('timeupdate', updateProgress);
    audioPlayer.addEventListener('ended', resetPlayer);
    volumeDownIcon.addEventListener('click', toggleMute);
    volumeBar.addEventListener('input', setVolume);

    function togglePlayPause() {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playPauseButton.classList.remove('fa-play');
            playPauseButton.classList.add('fa-pause');
        } else {
            audioPlayer.pause();
            playPauseButton.classList.remove('fa-pause');
            playPauseButton.classList.add('fa-play');
        }
    }

    function updateProgress() {
        const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        if (!isNaN(audioPlayer.duration)) {
            progress.style.width = percent + '%';
            currentTime.textContent = formatTime(audioPlayer.currentTime);
            duration.textContent = formatTime(audioPlayer.duration);
        } else {
            progress.style.width = '0%';
            currentTime.textContent = '0:00';
            duration.textContent = '0:00';
        }
    }

    function resetPlayer() {
        playPauseButton.classList.remove('fa-pause');
        playPauseButton.classList.add('fa-play');
        progress.style.width = '0%';
        currentTime.textContent = '0:00';

        if (isShuffle) {
            shufflePlaylist();
        }
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }

    function toggleMute() {
        audioPlayer.muted = !audioPlayer.muted;
        updateVolumeIcon();
    }

    function setVolume() {
        audioPlayer.volume = volumeBar.value / 100;
        updateVolumeIcon();
    }

    function updateVolumeIcon() {
        if (audioPlayer.muted || audioPlayer.volume === 0) {
            volumeDownIcon.classList.remove('fa-volume-down');
            volumeDownIcon.classList.add('fa-volume-off');
        } else {
            volumeDownIcon.classList.remove('fa-volume-off');
            volumeDownIcon.classList.add('fa-volume-down');
        }
    }

    const shuffleButton = document.querySelector('.fa-random');
    const retryButton = document.querySelector('.fa-undo-alt');

    shuffleButton.addEventListener('click', toggleShuffle);
    retryButton.addEventListener('click', retryTrack);

    let isShuffle = false;

    function toggleShuffle() {
        isShuffle = !isShuffle;
        if (isShuffle) {
            shuffleButton.classList.add('active');
        } else {
            shuffleButton.classList.remove('active');
        }
    }

    function retryTrack() {
        audioPlayer.currentTime = 0;
        if (!audioPlayer.paused) {
            audioPlayer.play();
        }
    }

    var playlist = <?php echo json_encode($playlist); ?>;

    function shufflePlaylist() {
        // Implement your shuffle logic here.
        // You may need to modify your playlist array accordingly.
        // For example, if you have an array of track URLs, shuffle that array.
        // You can use the Fisher-Yates algorithm for shuffling.

        // Example:
        for (let i = playlist.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [playlist[i], playlist[j]] = [playlist[j], playlist[i]];
        }

        // After shuffling, you may want to set the first track as the current track.
        audioPlayer.src = playlist[0];
        audioPlayer.load();
        audioPlayer.play();
    }

    const nextButton = document.querySelector('.fa-step-forward');
    const prevButton = document.querySelector('.fa-step-backward');

    nextButton.addEventListener('click', playNext);
    prevButton.addEventListener('click', playPrevious);

    let currentTrackIndex = 0;

    function playNext() {
        if (isShuffle) {
            shufflePlaylist();
        } else {
            currentTrackIndex = (currentTrackIndex + 1) % playlist.length;
            playCurrentTrack();
        }

        playPauseButton.classList.remove('fa-play');
        playPauseButton.classList.add('fa-pause');
    }

    function playPrevious() {
        if (isShuffle) {
            shufflePlaylist();
        } else {
            currentTrackIndex = (currentTrackIndex - 1 + playlist.length) % playlist.length;
            playCurrentTrack();
        }

        playPauseButton.classList.remove('fa-play');
        playPauseButton.classList.add('fa-pause');
    }

    var playlist2 = <?php echo json_encode($playlist2); ?>

    function playAudio(id) {
        for (let i = 0; i < playlist2.length; i++) {
            const itemPlaylist = playlist2[i];
            if (itemPlaylist.id == id) {
                currentTrackIndex = i
            }
        }
        playCurrentTrack();

        playPauseButton.classList.remove('fa-play');
        playPauseButton.classList.add('fa-pause');
    }

    function playCurrentTrack() {
        audioPlayer.src = playlist[currentTrackIndex];
        audioPlayer.load();
        audioPlayer.play();

        const currentSong = playlist2[currentTrackIndex];
        document.querySelector('.title').textContent = currentSong.title;
        document.querySelector('.artist').textContent = currentSong.artist;
        document.querySelector('.image-container img').src = './images/' + currentSong.image;
    }
</script>