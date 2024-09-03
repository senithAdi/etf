<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "socialbook","3307");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$userName = $_POST['txtEmail'];
$password = $_POST['txtPassword'];


$sql = "SELECT * FROM `tbluser` WHERE `email` = '".$userName."' and `password` = '".$password."'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["userName"] = $userName;
        
    // Set isAdmin session variable
    $_SESSION["isAdmin"] = ($row['isAdmin'] == 1);

    
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
