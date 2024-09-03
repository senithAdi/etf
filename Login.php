<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | sign Up</title>
    <link href="img/titleLogo.png" rel="shortcut icon" />
    <link rel="stylesheet" href="Style.css">

</head>

<body>

    <!--JS for Form Validation-->
    <script>

        function validateFullName() {

            var fname = document.getElementById("txtFullName").value;

            if ((fname == "") || (fname == null)) {

                alert("Please enter full name");
                return false;
            }
            return true;
        }

        function validateEmail() {

            var email = document.getElementById("txtEmail").value;

            var at = email.indexOf("@");
            var dt = email.lastIndexOf(".");
            var len = email.length;

            if ((at < 2) || (dt - at) < 2 || (len - dt) < 2) {

                alert("Please enter a valid email address");
                return false;
            }
            return true;
        }


        function validatePassword() {
            let pass = document.getElementById("txtPassword").value;

            let cPass = document.getElementById("txtConfirmPassword").value;

            if (pass.length < 5 || pass != cPass) {
                alert("Please enter correct password.");
                return false;
            }
            return true;
        }

        function validateContact() {

            var contact = document.getElementById("txtContact").value;

            if ((isNaN(contact)) || (contact.length != 10)) {

                alert("Please enter the valid Contact");
                return false;
            }
            return true;
        }

        function validateData(event) {
            if (validateFullName() && validateEmail() && validatePassword() && validateContact()) {
                alert("The reservation has been added successfully");
            } else {
                event.preventDefault();
            }
        }

    </script>

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
                <li><a href="Login.html"><img src="img/icons8-user-50.png" class="avatar"></a></li>
            </ul>
        </nav>

    </div>

    <!--Login Form-->
    <section class="intro-section-Form">
        <div class="overlay-Form">

            <h1 class="formH" style="margin-left:250px;">Socialbook LoginForm</h1>

            <div class="container-Form" id="container">
                <div class="form-container sign-up">
                    <form action="RegistrationHandler.php" method="post">
                        <h1>Create Account</h1>
                        <input type="text" placeholder="Name" id="txtFullName" name="txtName">
                        <input type="email" placeholder="Email" id="txtEmail" name="txtEmail">
                        <input type="password" placeholder="Password" id="txtPassword" name="txtPassword">
                        <input type="password" placeholder="Confirm Password" id="txtConfirmPassword">
                        <input type="text" placeholder="Contact" id="txtContact" name="txtContact">
                        <button onclick="validateData(event)" type="submit" value="Sign Up" name = "btnSubmit">Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in">
                    <form action="loginHandler.php" method="post">
                        <h1>Sign In</h1>
                        <input type="email" placeholder="Email" name="txtEmail">
                        <input type="password" placeholder="Password" name="txtPassword">
                        <a href="#" class="fp">Forget password?</a>
                        <button type="submit" value="Sign In" name="btnLog">Sign In</button>
                    </form>
                </div>
                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-left">
                            <h1>Welcome Back!</h1>
                            <p>Enter your personal details to use all of site features</p>
                            <button class="hidden" id="login">Sign In</button>
                        </div>
                        <div class="toggle-panel toggle-right">
                            <h1>Hello, User !</h1>
                            <p>Register with your personal details to use all of site features</p>
                            <button class="hidden" id="register">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

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

    <script>

        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });
        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

    </script>


</body>

</html>