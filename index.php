<?php
session_start();

$users = [
    "user@example.com" => "password123",
    "admin@example.com" => "adminpass",
    "shanker@example.com" => "shanker",
    "kaung@example.com" => "kaung"
];

// Check if the user is logging in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    if (isset($users[$email]) && $users[$email] === $password) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userEmail'] = $email; 
        header("Location: index.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password.";
    }
}

// If the user is not logged in, show the login page
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Spotify Login</title>
        <link rel="stylesheet" href="/style.css">
    </head>

    <body>
        <div style="width: fit-content; margin: 200px auto;" class="login-container">
            <h1 class="login-header"">Login to <span style=" color: green; font-weight: 900; font-size: 40px;">Shanker's</span> Spotify</h1>
            <?php if (!empty($errorMessage)): ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form method="POST">
                <div style="margin-bottom: 20px; display: flex; justify-content: space-between">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div style="margin-bottom: 20px; display: flex; justify-content: space-between">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button style="background-color: slateblue; color: whitesmoke; border-radius: 5px; border: none; padding: 6px 15px;" type="submit" name="login">Login</button>
            </form>
        </div>
    </body>

    </html>
<?php
    exit();
}

$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$songsDir = $baseUrl . '/songs';
$coversDir = $baseUrl . '/covers';

$songs = [
    ["songName" => "Warriyo - Mortals [NCS Release]", "filePath" => "$songsDir/1.mp3", "coverPath" => "$coversDir/1.jpg"],
    ["songName" => "Cielo - Huma-Huma", "filePath" => "$songsDir/2.mp3", "coverPath" => "$coversDir/2.jpg"],
    ["songName" => "DEAF KEV - Invincible [NCS Release]-320k", "filePath" => "$songsDir/3.mp3", "coverPath" => "$coversDir/3.jpg"],
    ["songName" => "Different Heaven & EH!DE - My Heart [NCS Release]", "filePath" => "$songsDir/4.mp3", "coverPath" => "$coversDir/4.jpg"],
    ["songName" => "Janji-Heroes-Tonight-feat-Johnning-NCS-Release", "filePath" => "$songsDir/5.mp3", "coverPath" => "$coversDir/5.jpg"],
    ["songName" => "Rabba - Salam-e-Ishq", "filePath" => "$songsDir/2.mp3", "coverPath" => "$coversDir/6.jpg"],
    ["songName" => "Sakhiyaan - Salam-e-Ishq", "filePath" => "$songsDir/2.mp3", "coverPath" => "$coversDir/7.jpg"],
    ["songName" => "Bhula Dena - Salam-e-Ishq", "filePath" => "$songsDir/2.mp3", "coverPath" => "$coversDir/8.jpg"],
    ["songName" => "Tumhari Kasam - Salam-e-Ishq", "filePath" => "$songsDir/2.mp3", "coverPath" => "$coversDir/9.jpg"],
    ["songName" => "Na Jaana - Salam-e-Ishq", "filePath" => "$songsDir/4.mp3", "coverPath" => "$coversDir/10.jpg"],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify - Your favourite music is here</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <ul>
            <li class="brand"><img src="logo.png" alt="Spotify"> Spotify</li>
            <li>Home</li>
            <li>About</li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="songList">
            <h1>Best of NCS - No Copyright Sounds</h1>
            <div class="songItemContainer">
                <?php foreach ($songs as $index => $song): ?>
                    <div class="songItem">
                        <img src="<?php echo $song['coverPath']; ?>" alt="<?php echo $index + 1; ?>">
                        <span class="songName"><?php echo $song['songName']; ?></span>
                        <span class="songlistplay"><span style="margin-right: 15px;">5:34</span>
                            <span id="<?php echo $index; ?>" class="far songItemPlay fa-play-circle">Play</span>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="songBanner"></div>
    </div>

    <div class="bottom">
        <input type="range" name="range" id="myProgressBar" min="0" value="0" max="100">
        <div class="icons">
            <i class="fas fa-3x fa-step-backward" id="previous">Prev</i>
            <i class="far fa-3x fa-play-circle" id="masterPlay">Play</i>
            <i class="fas fa-3x fa-step-forward" id="next">Next</i>
        </div>
        <div class="songInfo">
            <img src="playing.gif" width="42px" alt="" id="gif"> <span id="masterSongName">Warriyo - Mortals [NCS
                Release]</span>
        </div>
    </div>

    <script>
        const songs = <?php echo json_encode($songs); ?>;
    </script>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/26504e4a1f.js" crossorigin="anonymous"></script>
</body>

</html>