<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = $_POST["otp"];
    $new_password = $_POST["new_password"];

    // Check if OTP is valid
    $sql = "SELECT * FROM otp_table WHERE email = '$email' AND otp = '$otp' AND timestamp >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Update password in tbl_login
        $sql = "UPDATE tbl_login SET password = '$new_password' WHERE username = '$email'";
        mysqli_query($con, $sql);

        // Delete OTP from the database
        $sql = "DELETE FROM otp_table WHERE email = '$email'";
        mysqli_query($con, $sql);

        echo "Password reset successful.";
    } else {
        echo "Invalid OTP or OTP expired.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email" required>
        OTP: <input type="text" name="otp" required>
        New Password: <input type="password" name="new_password" required>
        <input type="submit" name="submit" value="Reset Password">
    </form>
</body>
</html>