<?php
$conn = mysqli_connect("localhost","root","","miniproject");

if(!$conn){
    die("Not Connected");
}

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Get the product ID from the URL
if(isset($_GET["id"])){
    $product_id = $_GET["id"];
}else{
    $product_id = $_POST["product_id"];
}

// Get the product details from the database
$sql = "SELECT * FROM product_details WHERE shoe_id = '$product_id'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    
    // Check if the product is in stock
    if ($row['stock_quantity'] <= 0) {
        echo "<script>alert('This product is currently out of stock.'); window.location.href='products.php';</script>";
        exit;
    }
} else {
    echo "Product not found.";
    exit;
}

// Check if the user has already placed an order for this product
$sql_check_order = "SELECT * FROM orders WHERE user_id = '".$_SESSION['user_id']."' AND product_id = '$product_id' AND order_status = 'pending'";
$res_check_order = mysqli_query($conn, $sql_check_order);
if (mysqli_num_rows($res_check_order) > 0) {
    echo "<script>alert('You have already placed an order for this product.'); window.location.href='products.php';</script>";
    exit;
}

// Handle order placement
if (isset($_POST['place_order'])) {
    // Check stock again before placing the order
    $sql_check_stock = "SELECT stock_quantity FROM product_details WHERE shoe_id = '$product_id'";
    $res_check_stock = mysqli_query($conn, $sql_check_stock);
    $stock_row = mysqli_fetch_assoc($res_check_stock);
    
    if ($stock_row['stock_quantity'] <= 0) {
        echo "This product is currently out of stock.";
        exit;
    }

    // Proceed with order placement
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $payment_method = 'Cash on Delivery';
    $order_date = date('Y-m-d H:i:s'); // Get the current date and time
    $ip = $_SERVER['REMOTE_ADDR']; // Get the IP address of the ordering device

    // Insert order into database
    $sql_order = "INSERT INTO orders (user_id, order_date, product_id, address, city, state, pincode, mobile, ip, order_status) VALUES ('$user_id', '$order_date', '$product_id', '$address', '$city', '$state', '$pincode', '$mobile', '$ip', 'pending')";
    mysqli_query($conn, $sql_order);

    // Get the last inserted order ID
    $order_id = mysqli_insert_id($conn);

    // Update product stock quantity
    $sql_update_stock = "UPDATE product_details SET stock_quantity = stock_quantity - 1 WHERE shoe_id = '$product_id'";
    mysqli_query($conn, $sql_update_stock);

    header('Location: orderplaced.php?order_id=' . $order_id);
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>THE FIND</title>
        <link rel="icon" href="image/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="orderingstyle.css">
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2 style="color: white;">Place Order</h2>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <label for="address">Address:</label>
            <input type="text" name="address" required><br><br/>

            <label for="city">City:</label>
            <input type="text" name="city" required><br><br/>

            <label for="state">State:</label>
            <input type="text" name="state" required><br><br/>

            <label for="pincode">Pincode:</label>
            <input type="text" name="pincode" required><br><br/>

            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" required><br><br/>

            <input type="submit" name="place_order" value="Place Order">
        </form>
    </body>
</html>