<?php
include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
$user_id = $_SESSION['user'];
$query = "SELECT email, phone, totalAmount, lastUpdate FROM tbl_registration WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$user_info = mysqli_fetch_assoc($result);
?>

<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <?php include('msgbox.php'); ?>
                <div class="about span_1_of_2">
                    <h3>User Profile</h3>
                    <p>Email: <?php echo $user_info['email']; ?></p>
                    <p>Phone: <?php echo $user_info['phone']; ?></p>
                    <h3>Update Information</h3>
                    <form method="post" action="update_profile.php">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $user_info['email']; ?>" required>
                        <br>
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $user_info['phone']; ?>" required>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <h3>Delete Account</h3>
                    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                    <button data-toggle="modal" data-target="#delete-modal" class="btn btn-danger">Delete Account</button>
                </div>
                <div class="about span_1_of_2">
                    <h3>Prepaid Details</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th>Total Amount</th>
                            <th>Last Update</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tk <?php echo $user_info['totalAmount']; ?></td>
                                <td><?php echo $user_info['lastUpdate']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Update your prepaid</h3>
                    <div>
                        <label for="display-name"> Give the amount:
                            <span class="warning">*(Allows only digits.)</span>
                        </label>
                        <form method="post" action="update.php">
                            <input type="number" id="update" name="newAmountCard" pattern="^(0|(([1-9]{1}|[1-9]{1}[0-9]{1}|[1-9]{1}[0-9]{2}){1}(\ [0-9]{3}){0,})),(([0-9]{2})|\-\-)([\ ]{1})$" maxlength="250" minlength="1" required />
                            <button class="btn btn-success btn-sm"><a style="color:white;text-decoration: none;" href='update.php?id=<?php echo $user_info['prepaid_id']; ?>'>Update your card</a></button>
                            <span></span>
                        </form>
                    </div>
                </div>
                <div class="about span_1_of_2">
                    <h3>Bookings</h3>
                    <?php
                    $bk = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE user_id='" . $_SESSION['user'] . "'");
                    if (mysqli_num_rows($bk)) {
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>Ticket ID</th>
                                <th>Band</th>
                                <th>Stadium</th>
                                <th>Tier</th>
                                <th>Show</th>
                                <th>Seats</th>
                                <th>Amount</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($bkg = mysqli_fetch_array($bk)) {
                                    $m = mysqli_query($con, "SELECT * FROM tbl_concert WHERE concert_id=(SELECT concert_id FROM tbl_shows WHERE s_id='" . $bkg['show_id'] . "')");
                                    $mov = mysqli_fetch_array($m);
                                    $s = mysqli_query($con, "SELECT * FROM tbl_screens WHERE screen_id='" . $bkg['screen_id'] . "'");
                                    $srn = mysqli_fetch_array($s);
                                    $tt = mysqli_query($con, "SELECT * FROM tbl_stadium WHERE id='" . $bkg['t_id'] . "'");
                                    $thr = mysqli_fetch_array($tt);
                                    $st = mysqli_query($con, "SELECT * FROM tbl_show_time WHERE st_id=(SELECT st_id FROM tbl_shows WHERE s_id='" . $bkg['show_id'] . "')");
                                    $stm = mysqli_fetch_array($st);
                                ?>
                                    <tr>
                                        <td><?php echo $bkg['ticket_id']; ?></td>
                                        <td><?php echo $mov['concert_name']; ?></td>
                                        <td><?php echo $thr['name']; ?></td>
                                        <td><?php echo $srn['screen_name']; ?></td>
                                        <td><?php echo $stm['name']; ?></td>
                                        <td><?php echo $bkg['no_seats']; ?></td>
                                        <td>Tk <?php echo $bkg['amount']; ?></td>
                            </tr>
                        <?php
                                }
                        ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<p>You have no bookings.</p>";
                    }
                    ?>
                </div>
                <?php include('concert_sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-label">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="delete_account.php" class="btn btn-danger">Delete Account</a>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>


<!-- <td>
<a href="generate_ticket_pdf.php?id=<?php echo $bkg['id']; ?>">Generate PDF</a>
<a href="cancel_booking.php?id=<?php echo $bkg['id']; ?>" onclick='return confirm("Are you sure you want to cancel this booking?")'>Cancel</a>
</td> -->