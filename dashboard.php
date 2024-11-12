<?php
session_start();

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'miniproject';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Retrieve user data
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Retrieve order history
$sql = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $row['user_id']);
$stmt->execute();
$order_result = $stmt->get_result();

// Retrieve wishlist items
$sql = "SELECT * FROM wishlist WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $row['user_id']);
$stmt->execute();
$wishlist_result = $stmt->get_result();

// HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Dashboard | THE FIND</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="dashboardstyle.css">
</head>
<body>
    <section id="header">
        <a href="#"> <img id="headlogo" src="image/logo.png" type="image/png"> </a>
        <ul id="navbar">
            <li><a href="home.php">HOME</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="dashboard.php"> <img id="acclogo" src="image/account.png" type="image/png"> </a></li>
        </ul>
    </section>
    <section id="hero">
        <h1 style="font-size: 70px; color: transparent;">dydyd</h1>
    </section>
    <section id="dashboard">
        <h1 style="margin-left:60px; margin-bottom: 20px; color: #fff; font-size: 40px;">Dashboard</h1>
        <div class="dashboard-container">
            <div class="account-info">
                <h2 style="margin-bottom: 20px;">Account Details</h2>
                <ul>
                    <li><strong>Username:</strong> <?php echo $row['username']; ?></li>
                    <li><strong>Email:</strong> <?php echo $row['email']; ?></li>
                    <li><strong>Account Type:</strong> <?php echo $row['account_type']; ?></li>
                </ul>
            </div>
            <?php if ($row['account_type'] === 'user'): ?>
                <div class="order-history">
                    <h2 style="margin-bottom: 20px;">Order History</h2>
                    <ul>
                        <?php
                        if ($order_result->num_rows > 0) {
                            while ($order_row = $order_result->fetch_assoc()) {
                                echo "<li>Order #" . $order_row['order_id'] . " - Date: " . $order_row['order_date'] . " - Status: " . $order_row['order_status'] . "</li>";
                            }
                        } else {
                            echo "<li>No orders yet</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="wishlist">
                    <h2 style="margin-bottom: 20px;">Wishlist</h2>
                    <ul>
                        <?php
                        if ($wishlist_result->num_rows > 0) {
                            while ($wishlist_row = $wishlist_result->fetch_assoc()) {
                                echo "<a href='productdetails.php?id=" . $wishlist_row['shoe_id'] . "'>" . $wishlist_row['product_name'] . "</a><br>";
                            }
                        } else {
                            echo "<li>No items yet</li>";
                        }
                        ?>
                    </ul>
                </div>
                <a class='logout' href="logout.php">LOGOUT</a>

            <?php elseif ($row['account_type'] === 'admin'): ?>
                <!-- Include editing tools for admin users -->
                <div class="editing-tools">
                    <h2 style="margin-bottom: 20px">Editing Tools</h2>
                    <ul>
                        <li><a href="addproduct.php">Add Product</a></li>
                        <li><a href="editproduct.php">Edit Product</a></li>
                        <li><a href="deleteproduct.php">Delete Product</a></li>
                    </ul>
                </div>
                <div class="most-searched">
                    <h2 style="margin-bottom: 20px;">Most Searched Items</h2>
                    <ul>
                        <?php
                        $sql = "SELECT word, COUNT(*) as count FROM mostsearched GROUP BY word HAVING COUNT(*) > 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $search_result = $stmt->get_result();
                        if ($search_result->num_rows > 0) {
                            while ($search_row = $search_result->fetch_assoc()) {
                                echo "<li>" . $search_row['word'] . " (" . $search_row['count'] . " searches)</li>";
                            }
                        } else {
                            echo "<li>No items yet</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="most-sold">
                    <h2 style="margin-bottom: 20px;">Most Sold Items</h2>
                    <ul>
                        <?php
                        $sql = "SELECT product_id, COUNT(*) as count FROM orders GROUP BY product_id ORDER BY count DESC LIMIT 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $sold_result = $stmt->get_result();
                        if ($sold_result->num_rows > 0) {
                            while ($sold_row = $sold_result->fetch_assoc()) {
                                // Get product name from product_details table
                                $sql = "SELECT name FROM product_details WHERE shoe_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $sold_row['product_id']);
                                $stmt->execute();
                                $product_result = $stmt->get_result();
                                if ($product_result->num_rows > 0) {
                                    $product_row = $product_result->fetch_assoc();
                                    $product_name = $product_row['name'];
                                    echo "<li>" . $product_name . " (" . $sold_row['count'] . " sales)</li>";
                                } else {
                                    echo "<li>No product name found</li>";
                                }
                            }
                        } else {
                            echo "<li>No items yet</li>";
                        }
                        ?>
                    </ul>
                </div>
                <a class='logout' href="logout.php">LOGOUT</a>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>