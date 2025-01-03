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

// Check if the item to remove has been specified
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Remove the item from the wishlist
    $delete_sql = "DELETE FROM wishlist WHERE shoe_id = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("ii", $item_id, $_SESSION['user_id']); // Assuming user_id is stored in session
    $stmt->execute();
}

// Redirect back to the dashboard
header('Location: dashboard.php');
exit;
?>