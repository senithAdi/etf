<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";  // replace with your DB username
$password = "";      // replace with your DB password
$dbname = "socialbook";  // replace with your DB name

$con = mysqli_connect($servername, $username, $password, $dbname,"3307");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get email and password from POST
$userName = $_POST['txtEmail'];
$password = $_POST['txtPassword'];

// Note: this is vulnerable to SQL injection!
$sql = "SELECT * FROM `tbluser` WHERE `email` = '".$userName."' and `password` = '".$password."'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["userName"] = $userName;
    
    // Check if the user is an admin
    if ($row['isAdmin'] == 1) {
        header('Location: Admin.php');
    } else {
        header('Location: MyAccount.php');
    }
} else {
    header('Location: Login.php');
}

mysqli_close($con);
?>
