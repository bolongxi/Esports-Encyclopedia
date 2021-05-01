<?php
session_start(); // see session variables
session_destroy(); // delete session variables
header("Location: index.php"); // send back to homepage