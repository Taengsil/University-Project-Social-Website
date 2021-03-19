<?php require_once 'controllers/authController.php';
require_once 'controllers/processForm.php';

// add if (!isset($_POST[$editprofile])) {
//    header('location: index.php');
//    exit();
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">

    <title>Edit Profile Picture</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="editpfp.php" method="post" enctype="multipart/form-data">
                    <h3 class="txt-center">Edit Profile Picture</h3>

                    <?php if (!empty($msg)) : ?>
                        <div class="alert <?php echo $css_class; ?>">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                        <br>
                    <div class="form-group">
                        <input type="file" name="profileImage" id="profileImage" class="form-control">
                        <br>
                        <button type="submit" name="savechangespfp-btn" class="btn btn-primary btn-block btn-lg">Save Changes</button>
                    </div>
                    <a href=<?php echo "index.php?profile=".$_SESSION['username']; ?> class="btn btn-danger btn-lg">Go back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>