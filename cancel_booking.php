<?php
include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $query = "DELETE FROM tbl_bookings WHERE id = '$booking_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $msg = "<div class='alert alert-success'>Booking canceled successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error canceling booking.</div>";
    }
}
?>

<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <?php include('msgbox.php'); ?>
                <div class="about span_1_of_2">
                    <h3>Cancel Booking</h3>
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
                    <p>Are you sure you want to cancel this booking? This action cannot be undone.</p>
                    <form method="post" action="cancel_booking.php">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                    </form>
                </div>
                <?php include('concert_sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>