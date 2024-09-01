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
		if(!$con)
		{	
			die("Cannot connect to DB server");		
		}
		$sql ="SELECT * FROM `tbluser` WHERE `email` = '".$_SESSION["userName"]."'";	
					
		$result = mysqli_query($con,$sql);
			
		if(mysqli_num_rows($result)> 0)
	     {
			while($row = mysqli_fetch_assoc($result))
			{
    ?>
  <p><?php echo $row["name"]; ?></p>
  <p><?php echo $row["contactNumber"]; ?></p>
  <p><?php echo $row["email"]; ?></p>
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