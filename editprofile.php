<?php require_once 'controllers/authController.php';
require_once 'controllers/editprofileForm.php';

// add if (!isset($_POST[$editpfp])) {
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

    <title>Edit Bio</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="editprofile.php" method="post">
                    <h3 class="txt-center">Edit Bio</h3>

                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" class="form-control form-control-lg" rows="3" ><?php echo $_SESSION['bio']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="savechanges-btn" class="btn btn-primary btn-block btn-lg">Save Changes</button>
                    </div>
                    <!-- -->
                    <a href=<?php echo "index.php?profile=".$_SESSION['username']; ?> class="btn btn-danger btn-lg">Go back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>