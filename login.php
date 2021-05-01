<?php
session_start();
require("connect.php");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT UserID, Username, Password FROM Users WHERE Username='$username' AND Password='$password'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0){
        // set session variables & redirect to homepage
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['UserID'];
        header("Location: http://3.230.1.132/index.php");
    }

    //login failed, redirecting to retry page
    else{
        header("Location: http://3.230.1.132/retryLogin.html");
    }
}

