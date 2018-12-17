<?php
session_start();
if (empty($_SESSION['username']))
{
    header("Location: login.php");
}
    require_once('config/database.php');
    $name = $_SESSION['username'];
    $result;
    try{
        $conn = new PDO($DSN_dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM `gallery` WHERE username = '". $name ."' ORDER BY upload_date DESC LIMIT 6 ", PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Camera/Upload</title>
    <link rel="stylesheet" href="cam.css">
    <link rel="stylesheet" href="cass.css">

</head>
<body>
<div class="bg"></div>
<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<p><?php echo $_SESSION['username'] ; ?> </p>
    <ul>
        <li><a href="home.php"> Home </a></li>
        <li><a href="gallery.php"> Gallery</a></li>   
       <li><a href="#">Edit Profile <i class="arrow down"> </i> </div> </a>
        <ul>
        <li> <a href="update_password.php">Password</a></li>
                    <li> <a href="editUsername.php">Usernames</a></li>
                    <li> <a href="editMail.php">Change Email</a></li>
                    <li> <a href="mailNotif.php">Mail Notification</a></li>
</ul>
        </li>
        <li><a href="logout.php">Logout </a></li>
</nav>
    <div class="c_upload">
    <input type="file" name="file" id="file">
    </div>
    <div class="c_camera">
        <div class="camField">
            <video id="video" width="400" height="300"></video>
        </div>
        <div class="picField">
            <canvas id="canvas" width="400" height="300"></canvas>
        </div>
        <div id="pose">
            <img id="e1" src="emojis/rasengan.png" width="45%" height="45%">
            <img id="e2" src="emojis/fire.png" width="45%" height="45%">
            <img id="e3" src="emojis/shidori.png" width="45%" height="45%">
            <img id="e4" src="emojis/jcat.png" width="45%" height="45%">
        </div>
    </div>
    <div class="buts">
        <button id="clear" class="clrBtn">Clear</button>
        <button id="capture" class="capBtn">Capture</button>
        <button id="capture1" class="emoBtn">Emoji</button>
        <select id="emos" class="emoSelect">
            <option value="e1">rasen-shiruken</option>
            <option value="e2">fire</option>
            <option value="e3">shidori</option>
            <option value="e4">jcat</option>
        </select>
        <form action="upload.php" method="POST">
            <input type="hidden" id="photo" name="image_data">
            <input name="call cam" type="submit" value=" Save pic " id="save" class="camBtn">
        </form>
    </div>
    <div id="gallery">
        <?php
            if ($result)
            foreach ($result as $row) {
                ?><img id="e1" src=<?= $row['img_name']; ?> width="29%" height="auto"><?php
            }
            else
                echo "failure";
        ?>
    </div>
    <script src="cam.js"></script>
</body>
</HTML>
