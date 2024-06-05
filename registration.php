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
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form action="process_registration.php" method="post" id="form1">
                            <div class="form-group has-feedback">
                                <input name="name" type="text" size="25" placeholder="Name" class="form-control" />
                                <?php $frm->validate("name", array("required", "label" => "Name", "regexp" => "name")); ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <input name="phone" type="text" size="25" placeholder="Mobile Number" class="form-control" />
                                <?php $frm->validate("phone", array("required", "label" => "Mobile Number", "regexp" => "mobile")); ?>
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="email" type="text" size="25" placeholder="Email" class="form-control" />
                                <?php $frm->validate("email", array("required", "label" => "Email", "email")); ?>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="password" type="password" size="25" placeholder="Password" class="form-control" placeholder="Password" />
                                <?php $frm->validate("password", array("required", "label" => "Password", "min" => "7")); ?>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="cpassword" type="password" size="25" placeholder="Confirm Password" class="form-control" placeholder="Confirm Password" />
                                <?php $frm->validate("cpassword", array("required", "label" => "Confirm Password", "min" => "7", "identical" => "password Password")); ?>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <div class="text-center">
                                <a href="admin_login.php" class="btn btn-secondary">Login as Admin</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>



<!-- <div class="form-group has-feedback">
                                <input name="age" type="text" size="25" placeholder="Age" class="form-control" />
                                <?php $frm->validate("age", array("required", "label" => "Age", "regexp" => "age")); ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <select name="gender" class="form-control">
                                    <option value>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <?php $frm->validate("gender", array("required", "label" => "Gender")); ?>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div> -->