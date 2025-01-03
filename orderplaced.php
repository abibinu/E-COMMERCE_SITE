<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Get the order ID from the URL parameter
$order_id = $_GET['order_id'];

// Get the order details from the database
$conn = mysqli_connect("localhost", "root", "", "miniproject");
if (!$conn) {
    die("Not Connected");
}

$sql = "SELECT orders.*, product_details.name AS product_name, product_details.price AS product_price 
        FROM orders 
        JOIN product_details ON orders.product_id = product_details.shoe_id 
        WHERE orders.order_id = '$order_id'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
} else {
    echo "Order not found.";
    exit;
}

// Display order details
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Order Placed</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="orderplacedstyle.css">
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
    <div id="order-placed">
    <h2>Order Placed Successfully!</h2>
    <p>Order ID: <?php echo $order_id; ?></p>
    <p>Product: <?php echo $row['product_name']; ?></p>
    <p>Price: $<?php echo $row['product_price']; ?></p>
    <p>Address: <?php echo $row['address']; ?>, <?php echo $row['city']; ?>, <?php echo $row['state']; ?> - <?php echo $row['pincode']; ?></p>
    <p>Mobile: <?php echo $row['mobile']; ?></p>
    <p>Payment Method: Cash on Delivery</p>
    <p>Order Status: Pending</p>
    <p>Thank you for your order. Our team will process your order soon.</p>
    <a style="color: orange;" href="products.php">Continue Shopping</a>
    <br>
    <a style="color: green;" href="generate_invoice.php?order_id=<?php echo $order_id; ?>">Download Invoice</a>
</div>

</body>
</html>