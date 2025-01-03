<?php
require('fpdf.php'); // Make sure to include the FPDF library

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Get the order ID from the URL parameter
$order_id = $_GET['order_id'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "miniproject");
if (!$conn) {
    die("Not Connected");
}

// Get order details
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

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Invoice');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Order ID: ' . $row['order_id']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Product: ' . $row['product_name']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Price: $' . $row['product_price']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Address: ' . $row['address'] . ', ' . $row['city'] . ', ' . $row['state'] . ' - ' . $row['pincode']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Mobile: ' . $row['mobile']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Payment Method: Cash on Delivery');
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Order Status: Pending');
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Thank you for your order.');

// Output the PDF
$pdf->Output('D', 'invoice_' . $order_id . '.pdf');
?>