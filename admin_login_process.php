<?php
session_start();
require_once 'config.php';

// Sanitize user input
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

// Check if the email and password match an admin account
$query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 1) {
    $admin = mysqli_fetch_assoc($result);
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    header('Location: admin_profile.php');
    exit;
} else {
    $error_message = 'Invalid email or password';
    header('Location: admin_login.php?error=' . urlencode($error_message));
    exit;
}