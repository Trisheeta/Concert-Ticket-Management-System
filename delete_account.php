<?php
include('header.php');
if(!isset($_SESSION['user']))
{
    header('location:login.php');
}

$user_id = $_SESSION['user'];

$delete_query = "DELETE FROM tbl_registration WHERE user_id = '$user_id'";
$result = mysqli_query($con, $delete_query);

if ($result) {
    session_unset();
    session_destroy();
    echo '<div class="alert alert-success">Account deleted successfully.</div>';
} else {
    echo '<div class="alert alert-danger">Error deleting account: ' . mysqli_error($con) . '</div>';
}
?>

<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <?php include('msgbox.php'); ?>

                <div class="about span_1_of_2">
                    <h3>Account Deletion</h3>
                    <p>Your account has been deleted.</p>
                    <a href="index.php" class="btn btn-primary">Go to Home</a>
                </div>

                <?php include('concert_sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>