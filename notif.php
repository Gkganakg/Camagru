<?php session_start();

include('config/database.php');

$logged = $_SESSION['username'];
if (isset($_POST['check'])){
    $set = $_POST['check'];
}
else{
    $set = null;
    $_SESSION['notif'] = "Nothing was selected Email notification  is enabled by default";
    header("Location:   mailNotif.php");
}
if ($set == 'Yes'){
    try{
    $conn = new PDO($DSN_dbname , $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("UPDATE users SET mailNotif = ? WHERE Username = ?");
    $pdo->execute(array(1, $logged));
    $_SESSION['notif'] = "Email notification enabled";
    header("Location: mailNotif.php");
    }
    catch(PDOexception $e){
        $_SESSION['notif'] = "Something went wrong with connection";
        header("Location: mailNotif.php");
    }
}
if ($set == 'No'){
    try{
    $conn = new PDO($DSN_dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("UPDATE users SET mailNotif = ? WHERE Username = ?");
    $pdo->execute(array(0, $logged));
    $_SESSION['notif'] = "Email notification disbled";
    header("Location: mailNotif.php");
    
    }
    catch(PDOexception $e){
        $_SESSION['notif'] = "Something went wrong with the connection";
        header("Location: mailNotif.php");
    }
}