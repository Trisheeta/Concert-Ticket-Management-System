<?php
session_start();
require_once 'config.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Retrieve admin information from the database
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admins WHERE id = '$admin_id'";
$result = mysqli_query($con, $query);
$admin = mysqli_fetch_assoc($result);
?>
<?php include('header.php'); ?>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <?php include('msgbox.php'); ?>
                <div class="about span_1_of_2">
                    <h3>Admin Profile</h3>
                    <p><strong>Name:</strong> <?php echo $admin['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $admin['email']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $admin['phone']; ?></p>
                    <div class="form-group">
                        <a href="manage_concert.php" class="btn btn-primary">Manage Concerts</a>
                    </div>
                </div>
                <?php include('concert_sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>