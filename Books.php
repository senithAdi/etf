<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "socialbook";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
// $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the database, ordered by category
$sql = "SELECT * FROM product ORDER BY category";
$result = $conn->query($sql);

// Function to generate book cards
function generateBookCards($books) {
    $output = '';
    foreach ($books as $book) {
        $output .= '
        <div class="book-card">
            <img src="' . htmlspecialchars($book["image_url"]) . '" alt="' . htmlspecialchars($book["book_name"]) . '" class="book-cover">
            <div class="book-info">
                <h3 class="book-title">' . htmlspecialchars($book["book_name"]) . '</h3>
                <p class="book-author">by ' . htmlspecialchars($book["authors_name"]) . '</p>
                <p class="book-price">Rs. ' . number_format($book["price"], 2) . '</p>
                <a href="Cart.html?name=' . urlencode($book["book_name"]) . '&quantity=1&price=' . $book["price"] . '">
                    <button class="buy-now-button">Buy Now</button>
                </a>
            </div>
        </div>';
    }
    return $output;
}

// Group books by category
$books_by_category = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $category = $row["category"];
        if (!isset($books_by_category[$category])) {
            $books_by_category[$category] = [];
        }
        $books_by_category[$category][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <title>Books</title>
    <link href="img/titleLogo.png" rel="shortcut icon" />
</head>
<body>
    <!-- Header -->
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

        <!--Picture with text-->
        <section class="intro-section">
        <div class="overlay">
            <div class="intro-text">
                <h1>Explore Our Book Categories</h1>
                <p>Dive into a world of knowledge with our extensive range of book categories. Whether you're into
                    fiction, non-fiction, science, history, or romance, we have something for everyone.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="book-cards-container">
    <?php
    if (!empty($books_by_category)) {
        foreach ($books_by_category as $category => $books) {
            // Add an ID to each category section
            $category_id = strtolower(str_replace(' ', '-', $category));
            echo "<div id='" . $category_id . "' class='heading'>";
            echo "<h1 style='margin-bottom:10px;'>" . htmlspecialchars($category) . "</h1>";
            echo "<div class='book-cards-container'>";
            echo generateBookCards($books);
            echo "</div>";
            echo "</div>";
            echo "<hr class='break'>";
        }
    } else {
        echo "<p>No books found.</p>";
    }
    ?>
    </div>

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

<?php $conn->close(); ?>