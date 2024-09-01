<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "socialbook";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle image upload
function uploadImage($file) {
    $target_dir = "adminImage/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return false;
    }
    
    // Check file size (limit to 5MB)
    if ($file["size"] > 5000000) {
        return false;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Add new product
        $category = $_POST['category'];
        $book_name = $_POST['book_name'];
        $authors_name = $_POST['authors_name'];
        $price = $_POST['price'];
        
        $image_url = "";
        if(isset($_FILES['image'])) {
            $upload_result = uploadImage($_FILES['image']);
            if($upload_result !== false) {
                $image_url = $upload_result;
            } else {
                echo "Failed to upload image.";
            }
        }

        $sql = "INSERT INTO product (category, book_name, authors_name, price, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $category, $book_name, $authors_name, $price, $image_url);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        // Update existing product
        $product_id = $_POST['product_id'];
        $category = $_POST['category'];
        $book_name = $_POST['book_name'];
        $authors_name = $_POST['authors_name'];
        $price = $_POST['price'];
        
        $image_url = $_POST['current_image_url'];
        if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $upload_result = uploadImage($_FILES['image']);
            if($upload_result !== false) {
                $image_url = $upload_result;
            } else {
                echo "Failed to upload new image. Using existing image.";
            }
        }

        $sql = "UPDATE product SET category=?, book_name=?, authors_name=?, price=?, image_url=? WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdsi", $category, $book_name, $authors_name, $price, $image_url, $product_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        // Delete product
        $product_id = $_POST['product_id'];

        // First, get the image URL to delete the file
        $sql = "SELECT image_url FROM product WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $image_url = $row['image_url'];
            if (file_exists($image_url)) {
                unlink($image_url);
            }
        }
        $stmt->close();

        // Now delete the product from the database
        $sql = "DELETE FROM product WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <title>Social Book - Product Management</title>
    <link href="img/titleLogo.png" rel="shortcut icon" />
    <style>
        .product-form {
            margin-bottom: 20px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
        }
        .product-item {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
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

    <!--Main Content-->
    <div class="content">
        <h1>Product Management</h1>

        <!-- Add Product Form -->
        <div class="product-form">
            <h2>Add New Product</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Children's">Children's</option>
                    <option value="Novels">Novels</option>
                    <option value="Translations">Translations</option>
                    <option value="Short Story">Short Story</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="Educational">Educational</option>
                </select>
                <input type="text" name="book_name" placeholder="Book Name" required>
                <input type="text" name="authors_name" placeholder="Author's Name" required>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <input type="file" name="image" accept="image/*" required>
                <input type="submit" name="submit" value="Add Product">
            </form>
        </div>

        <!-- Product List -->
        <div class="product-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row["image_url"] . "' alt='" . $row["book_name"] . "' width='100'>";
                    echo "<h3>" . $row["book_name"] . "</h3>";
                    echo "<p>Category: " . $row["category"] . "</p>";
                    echo "<p>Author: " . $row["authors_name"] . "</p>";
                    echo "<p>Price: $" . $row["price"] . "</p>";
                    
                    // Update Form
                    echo "<form method='POST' action='' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
                    echo "<input type='hidden' name='current_image_url' value='" . $row["image_url"] . "'>";
                    echo "<select name='category' required>";
                    $categories = array("Fiction", "Children's", "Novels", "Translations", "Short Story", "Science", "History", "Educational");
                    foreach ($categories as $category) {
                        echo "<option value='" . $category . "'" . ($category == $row["category"] ? " selected" : "") . ">" . $category . "</option>";
                    }
                    echo "</select>";
                    echo "<input type='text' name='book_name' value='" . $row["book_name"] . "' required>";
                    echo "<input type='text' name='authors_name' value='" . $row["authors_name"] . "' required>";
                    echo "<input type='number' name='price' value='" . $row["price"] . "' step='0.01' required>";
                    echo "<input type='file' name='image' accept='image/*'>";
                    echo "<input type='submit' name='update' value='Update'>";
                    echo "</form>";
                    
                    // Delete Form
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
                    echo "<input type='submit' name='delete' value='Delete'>";
                    echo "</form>";
                    
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>

    <!--Footer-->
    <footer class="footer">
        <!-- Footer content remains unchanged -->
    </footer>

</body>
</html>

<?php
$conn->close();
?>