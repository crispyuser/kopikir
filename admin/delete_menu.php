<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

// Get menu item ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Delete menu item from database
$conn = getConnection();
$stmt = $conn->prepare("DELETE FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Successfully deleted
    $message = 'Menu item deleted successfully!';
    $type = 'success';
} else {
    // Error occurred
    $message = 'Error deleting menu item: ' . $conn->error;
    $type = 'error';
}

$stmt->close();
$conn->close();

// Redirect back to dashboard with message
header('Location: index.php?message=' . urlencode($message) . '&type=' . $type);
exit;
?>