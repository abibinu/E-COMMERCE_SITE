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

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['account_type'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Fetch all user orders
$sql = "SELECT o.order_id, o.order_date, o.order_status, u.username, o.ip FROM orders o JOIN users u ON o.user_id = u.user_id";
$result = $conn->query($sql);

// Create a CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="user_orders_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Order ID', 'Username', 'Order Date', 'Order Status', 'IP Address']); // Header row

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['order_id'], $row['username'], $row['order_date'], $row['order_status'], $row['ip']]);
    }
} else {
    fputcsv($output, ['No orders found']);
}

fclose($output);
exit;
?>