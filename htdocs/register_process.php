<?php
// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $height = trim($_POST['height']);
    $weight = trim($_POST['weight']);

    // Basic validation
    if (empty($username) || empty($password) || empty($confirm_password) || empty($height) || empty($weight)) {
        header('Location: register.php?error=All fields are required');
        exit();
    }

    if ($password !== $confirm_password) {
        header('Location: register.php?error=Passwords do not match');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query
    $stmt = $conn->prepare('INSERT INTO users (username, password, height, weight) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssii', $username, $hashed_password, $height, $weight);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header('Location: login.php?success=Registration successful! Please log in.');
    } else {
        // Registration failed
        header('Location: register.php?error=An error occurred. Please try again.');
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
