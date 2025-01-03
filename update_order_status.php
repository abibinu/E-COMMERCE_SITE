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

// Check if the order_id is set 
if (!isset($_GET['order_id'])) {
    die("Invalid Order ID specified.");
}

$order_id = (int)$_GET['order_id']; // Cast to integer for safety

// Check if the form to update order status has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_status'])) {
    $order_status = $_POST['order_status'];

    // Update the order status in the database
    $update_sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $order_status, $order_id);
    
    if ($update_stmt->execute()) {
        // Redirect back to the dashboard or order history page
        header('Location: dashboard.php');
        exit;
    } else {
        die("Error updating order status: " . $conn->error);
    }
}

// Retrieve the current order status
$sql = "SELECT order_status FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order_row = $result->fetch_assoc();

if (!$order_row) {
    die("Order not found.");
}
// HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Update Order Status | THE FIND</title>
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
    <h1 style="font-size: 70px; color: transparent; margin-bottom: 120px;">dydyd</h1>
    <section id="update-order-status">
        
        <h1 style="margin: 20px 50px;">Update Order Status</h1>
        <form method="POST" action="">
            <label for="order_status">Current Status: <?php echo $order_row['order_status']; ?></label><br>
            <input style="margin: 20px 5px;" type="submit" name="delivered" value="delivered">
            <input style="margin: 20px 5px;" type="submit" name="cancelled" value="cancelled">
            <input style="margin: 20px 5px;" type="submit" name="pending" value="pending">
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
        <?php
        if (isset($_POST['delivered'])) {
            $order_status = 'delivered';
            $update_sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $order_status, $order_id);
            if ($update_stmt->execute()) {
                header('Location: dashboard.php');
                exit;
            } else {
                die("Error updating order status: " . $conn->error);
            }
        } elseif (isset($_POST['cancelled'])) {
            $order_status = 'cancelled';
            $update_sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $order_status, $order_id);
            if ($update_stmt->execute()) {
                header('Location: dashboard.php');
                exit;
            } else {
                die("Error updating order status: " . $conn->error);
            }
        } elseif (isset($_POST['pending'])) {
            $order_status = 'pending';
            $update_sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $order_status, $order_id);
            if ($update_stmt->execute()) {
                header('Location: dashboard.php');
                exit;
            } else {
                die("Error updating order status: " . $conn->error);
            }
        }
        ?>
    </section>
</body>
</html>