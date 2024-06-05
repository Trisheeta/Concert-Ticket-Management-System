<?php
include('header.php');
if(!isset($_SESSION['user']))
{
    header('location:login.php');
}

$user_id = $_SESSION['user'];
$query = "SELECT email, phone FROM tbl_registration WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$user_info = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update_query = "UPDATE tbl_registration SET email = '$email', phone = '$phone' WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $update_query);

    if ($result) {
        echo '<div class="alert alert-success">Profile updated successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Error updating profile: ' . mysqli_error($con) . '</div>';
    }
}
?>

<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <?php include('msgbox.php'); ?>

                <div class="about span_1_of_2">
                    <h3>Update Profile</h3>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $user_info['email']; ?>" required>
                        <br>
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $user_info['phone']; ?>" required>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>

                <?php include('concert_sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>