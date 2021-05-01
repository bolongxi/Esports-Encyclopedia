<?php
// This file validates the information and adds it into the database.
require("connect.php");

$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['password-repeat'];

$insertsql = "INSERT INTO Users(Username, Password) VALUES ('$username', '$password1')";

$selectsql = "SELECT Username, Password FROM Users WHERE Username='$username'";
$result = $conn->query($selectsql);

//username already exists in our table, redirecting to retry page
if ($result->num_rows > 0){
    header("Location: http://3.230.1.132/retrySignup.html");
}

//username created, redirecting to login page 
else if ($conn->query($insertsql) === TRUE) {
    header("Location: http://3.230.1.132/login.html");
}

else{
    echo "Error: ".$sql."<br>".mysqli_error($conn);
}

?>
