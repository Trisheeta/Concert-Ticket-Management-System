<?php include('header.php'); ?>
<link rel="stylesheet" href="validation/dist/css/bootstrapValidator.css" />
<script type="text/javascript" src="validation/dist/js/bootstrapValidator.js"></script>
<?php include('form.php'); $frm = new formBuilder; ?>
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .content {
        margin-top: 50px;
    }

    .panel {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .panel-default>.panel-heading {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .form-control {
        border-radius: 5px;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }
</style>

<div class="content">
    <div class="wrap">
        <div class="content-top" style="min-height:300px;padding:50px">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Forgot Password</div>
                    <div class="panel-body">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $email = $_POST["email"];
                            // Check if email exists in tbl_login
                            $sql = "SELECT * FROM tbl_login WHERE username = '$email'";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // Generate new password
                                $new_password = bin2hex(random_bytes(4)); // Generate a random 8-character password

                                // Update the password in the database
                                $sql = "UPDATE tbl_login SET password = '$new_password' WHERE username = '$email'";
                                mysqli_query($con, $sql);

                                echo "<div class='alert alert-success'>New password generated.</div>";
                                ?>
                                <div class="form-group">
                                    <label for="new-password">New Password:</label>
                                    <div class="input-group">
                                        <input type="text" id="new-password" class="form-control" value="<?php echo $new_password; ?>" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" onclick="copyPassword()">Copy</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="login.php" class="btn btn-primary btn-block">Go to Login</a>
                                </div>
                                <?php
                            } else {
                                echo "<div class='alert alert-danger'>Email not found in our records.</div>";
                            }
                        }
                        ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Generate New Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script>
    function copyPassword() {
        var passwordInput = document.getElementById("new-password");
        passwordInput.select();
        document.execCommand("copy");
        alert("Password copied to clipboard!");
    }
</script>

<?php include('footer.php'); ?>