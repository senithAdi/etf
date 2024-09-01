<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "socialbook";
// $port = 3307;

// $conn = new mysqli($servername, $username, $password, $dbname, $port);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

// Function to generate book cards
function generateBookCards($result) {
    $output = '';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $output .= '
            <div class="book-card">
                <img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["book_name"]) . '" class="book-cover">
                <div class="book-info">
                    <h3 class="book-title">' . htmlspecialchars($row["book_name"]) . '</h3>
                    <p class="book-author">by ' . htmlspecialchars($row["authors_name"]) . '</p>
                    <p class="book-price">Rs. ' . number_format($row["price"], 2) . '</p>
                    <a href="Cart.html?name=' . urlencode($row["book_name"]) . '&quantity=1&price=' . $row["price"] . '">
                        <button class="buy-now-button">Buy Now</button>
                    </a>
                </div>
            </div>';
        }
    } else {
        $output = "<p>No books found.</p>";
    }
    return $output;
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
    <!-- Header remains unchanged -->

    <!-- Main Content -->
    <div class="content">
        <h1>Our Book Collection</h1>

        <div class="book-cards-container">
            <?php echo generateBookCards($result); ?>
        </div>
    </div>

    <!-- Footer remains unchanged -->

</body>
</html>

<?php
$conn->close();
?>