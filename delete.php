<?php
require_once 'config.php';

// Get user ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

try {
    // Delete user
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    
    header("Location: index.php?deleted=1");
    exit;
} catch (PDOException $e) {
    header("Location: index.php?error=1");
    exit;
}
?>