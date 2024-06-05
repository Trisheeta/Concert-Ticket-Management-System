<?php
session_start();
require_once 'config.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_concert'])) {
        // Add concert
        $concert_name = mysqli_real_escape_string($con, $_POST['concert_name']);
        $cast = mysqli_real_escape_string($con, $_POST['cast']);
        $image = mysqli_real_escape_string($con, $_POST['image']);

        $query = "INSERT INTO tbl_concert (concert_name, cast, image) VALUES ('$concert_name', '$cast', '$image')";
        mysqli_query($con, $query);
    } elseif (isset($_POST['remove_concert'])) {
        // Remove concert
        $concert_id = mysqli_real_escape_string($con, $_POST['concert_id']);

        $query = "DELETE FROM tbl_concert WHERE concert_id = '$concert_id'";
        mysqli_query($con, $query);
    }
}

// Retrieve all concerts from the database
$query = "SELECT * FROM tbl_concert";
$result = mysqli_query($con, $query);
?>

<?php include('header.php'); ?>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <h3>Manage Concerts</h3>
            <div class="section group">
                <div class="about span_1_of_2">
                    <h4>Add Concert</h4>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="concert_name">Concert Name:</label>
                        <input type="text" id="concert_name" name="concert_name" required>
                        <br>
                        <label for="cast">Cast:</label>
                        <input type="text" id="cast" name="cast" required>
                        <br>
                        <label for="image">Image URL:</label>
                        <input type="text" id="image" name="image" required>
                        <br>
                        <button type="submit" name="add_concert" class="btn btn-primary">Add Concert</button>
                    </form>
                </div>
                <div class="about span_1_of_2">
                    <h4>Remove Concert</h4>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="concert_id">Concert ID:</label>
                        <select id="concert_id" name="concert_id" required>
                            <?php while ($concert = mysqli_fetch_assoc($result)): ?>
                                <option value="<?php echo $concert['concert_id']; ?>"><?php echo $concert['concert_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <br>
                        <button type="submit" name="remove_concert" class="btn btn-danger">Remove Concert</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>