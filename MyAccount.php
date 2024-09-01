<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <title>Social Book</title>
    <link href="img/titleLogo.png" rel="shortcut icon" />

    <style>

.account-info {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    max-width: 400px;
    margin: 20px auto;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.account-info img.profile-picture {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #007BFF;
    margin-bottom: 15px;
}

.account-info p {
    margin: 10px 0;
    font-size: 18px;
    font-weight: 500;
}

/* Upload Form */
.accForm {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.accForm label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    display: block;
}

.accForm input[type="file"] {
    margin: 10px 0;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.accForm input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.accForm input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    
        <!--Header-->
     <div class="header">

        <nav>
            <a href="index.html"><img src="img/logo.png" class="logo"></a>
                <ul class="nav-links">
                    <li>
                        <div class="search-container">
                            <form action="/action_page.php">
                                <input type="text" placeholder="Search.." class="search">
                                <button type="submit"><img src="img/search.png" class="avatar"></button>
                            </form>
                        </div>
                    </li>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="Books.html">BOOKS</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="Cart.html"><img src="img/icons8-cart-48.png" class="avatar"></a></li>
                    <li><a href="Login.php"><img src="img/icons8-user-50.png" class="avatar"></a></li>
                </ul>
        </nav>
    </div>

    <?php
        $con = mysqli_connect("localhost","root","","socialbook","3307");
        if(!$con) {	
            die("Cannot connect to DB server");		
        }

        if(isset($_POST['upload'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
            move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);

            $sql = "UPDATE `tbluser` SET `imagePath`='".$target_file."' WHERE `email` = '".$_SESSION["userName"]."'";
            mysqli_query($con, $sql);
        }

        $sql ="SELECT * FROM `tbluser` WHERE `email` = '".$_SESSION["userName"]."'";	
        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="account-info">
        <img src="<?php echo $row['imagePath'] ? $row['imagePath'] : 'img/default-avatar.png'; ?>" alt="Profile Picture" class="profile-picture">
        <p>Name: <?php echo $row["name"]; ?></p>
        <p>Contact: <?php echo $row["contactNumber"]; ?></p>
        <p>Email: <?php echo $row["email"]; ?></p>
    </div>
    
    <form action="MyAccount.php" method="post" enctype="multipart/form-data" class="accForm">
        <label for="profilePicture">Upload Profile Picture:</label>
        <input type="file" name="profilePicture" id="profilePicture">
        <input type="submit" name="upload" value="Upload" >
    </form>

    <?php
            }
        }
        mysqli_close($con);
    ?>


      <!--Footer-->
      <footer class="footer">
        <div class="container-footer">
            <div class="row">
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="Books.html">books</a></li>
                        <li><a href="About.html">about</a></li>
                        <li><a href="Cart.html">cart</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="FAQ.html">FAQ</a></li>
                        <li><a href="Cart.html">shipping</a></li>
                        <li><a href="Cart.html">returns</a></li>
                        <li><a href="Cart.html">order status</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Book Type</h4>
                    <ul>
                        <li><a href="Books.html#Fictions">Fictions</a></li>
                        <li><a href="Books.html#Novels">Novels</a></li>
                        <li><a href="Books.html#Translations">Translations</a></li>
                        <li><a href="Books.html#History">History</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/profile.php?id=100077104396165"><img src="img/Facebook.png"
                                height="46px" width="46px"
                                style="display:flex; margin-left: -3.5px; margin-top: -3px;"></a>

                        <a href="https://www.youtube.com/"><img src="img/utube.png" height="33px" width="33px"
                                style="display:flex; margin-left: 3px; margin-top: 3px;"></a>

                        <a href="https://www.instagram.com/senith.adithya/"><img src="img/insta.png" height="30px"
                                width="30px" style="display:flex; margin-left: 5px; margin-top: 5px;"></a>

                        <a href="https://www.blogger.com/blog/posts/6848685841490317236?bpli=1&pli=1"><img
                                src="img/blogger.png" height="30px" width="30px"
                                style="display:flex; margin-left: 5px; margin-top: 5px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>