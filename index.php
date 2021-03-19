<?php require 'profile.php'; ?>
<?php require 'controllers/comments.php'; ?>
<?php require_once 'controllers/authController.php';

// daca un utilizator nelogat incearca sa intre pe site, el va fi redirectionat la pagina de login;
if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
} 
// altfel, daca nu avem in variabila $user2 un user cautat, atunci mergem la profilul logat. 
else if (!isset($user2['username'])) {
    header('location: index.php?profile=' . $_SESSION['username']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-11 rounded" style="padding-top: 10px; padding-bottom: 10px; margin-top: 5%; margin-left: 52px; margin-right: 5px; margin-bottom:5px; background-color: white;">


                <!-- Login success alert -->

                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="index.php" method="GET">
                    <!-- Welcome, [username]! -->
                    <h4 align="center"> Welcome, <?php echo $_SESSION['username']; ?>!</h6>
                        <!-- Username search flavor text -->
                        <div class="input-group">
                            <a href="index.php?logout=1" class="btn btn-danger btn-lg">Logout</a>
                            <input type="text" name="profile" placeholder="Search for Users" class="form-control form-control-lg">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                        <!-- Search username has an error after button is pressed -->
                        <!-- -->
                        <?php if (count($searcherrors) > 0) : ?>
                            <div class="alert alert-danger">
                                <?php foreach ($searcherrors as $error) : ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!-- -->
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- left side box -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 rounded" style="padding-bottom: 10px; margin-left: 50px; margin-right: 5px; background-color: white;">
                <br>
                <!-- user image stuff -->
                <img src="<?php echo $user2['pfp']; ?>" class="img-fluid rounded mx-auto d-block" width="256" height="256"> <br>
                <!-- edit user image; make this invisible if visibleuserid != $_SESSION[id] -->
                <?php if ($_SESSION['username'] === $user2['username']) : ?>
                    <div class="form-group">
                        <form action=editpfp.php>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Edit Profile Picture</button>
                        </form>
                    </div>
                <?php endif ?>
                <!-- user info stuff -->
                <b> Real Name: </b><?php echo $user2['realname']; ?><br>
                <b> Username: </b><?php echo $user2['username']; ?><br>
                <b> E-Mail: </b><?php echo $user2['email']; ?><br>
                <!-- edit user info button -->
                <?php if ($_SESSION['username'] === $user2['username']) : ?>
                    <form action=editinfo.php>
                    <br>
                        <button type="submit" class="align-self-end btn btn-lg btn-block btn-primary" style="margin-top: auto;">Edit Info</button>
                    </form>
                <?php endif ?>
                
                <br>

                <b> Bio: </b><br>
                <?php echo $user2['bio'] ?>
                
                <br>
                
                <!-- edit bio button -->
                <?php if ($_SESSION['username'] === $user2['username']) : ?>
                    <form action=editprofile.php>
                    <br>
                        <button type="submit" class="align-self-end btn btn-lg btn-block btn-primary" style="margin-top: auto;">Edit Bio</button>
                    </form>
                <?php endif ?>


            </div>
            <!-- right side box -->
            <div class="col-lg-8 rounded" style="background-color: white;">
                <br>
                <form action=<?php echo "index.php?profile=" . $user2['username']; ?> method="POST">
                    <!-- comment flavor text & comment input box-->
                    <div class="form-group">
                        <label for="comment-post">Leave a comment below!</label>
                        <textarea class="form-control form-control-lg" name="comment-post" rows="3"></textarea>
                    </div>

                    <!-- comment "Post" button -->
                    <div class="form-group">
                        <button type="submit" name="comment-post-btn" class="btn btn-primary btn-lg" style="margin-left: 90%;">Post</button>
                    </div>
                </form>

                <!-- sort buttons -->
                <form action=<?php echo "index.php?profile=" . $user2['username']; ?> method="POST">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <button type="submit" name="sort" value="date" class="btn btn-secondary"> Date
                        <button type="submit" name="sort" value="postingrealname" class="btn btn-secondary"> Realname
                        <button type="submit" name="sort" value="postingusername" class="btn btn-secondary"> Username
                </div>
                </form>

                <br><br>



                <!-- very important magic for comments -->

                <?php foreach ($commentresults as $commentresult) : ?>
                    <?php
                    // commentresults has: postinguserid, postingrealname, postingusername, receivinguserid, date, commenttext;
                    $commentposteruserid = $commentresult['postinguserid'];
                    $commentposterrealname = $commentresult['postingrealname'];
                    $commentposterusername = $commentresult['postingusername'];
                    ?>
                    <div style="padding-left:0.5%; font-size: 0.95em;"> <b> <?php echo $commentposterrealname ?> @<?php echo $commentposterusername ?> </b>
                        <p class="alignright"> <?php echo $commentresult['date'] ?> </p>
                    </div>
                    <div class="form-group rounded" style="border: 1px solid #0003; margin-left:3px; font-size: 1.05em;">
                        <div style="margin:1%;"><?php echo $commentresult['commenttext']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- magic end -->
                <br>
                <br>
            </div>
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>