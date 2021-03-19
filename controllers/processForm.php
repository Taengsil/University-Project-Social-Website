<?php

require_once 'config/db.php';
$msg = "";
$css_class = "";
// if button is clicked
if (isset($_POST['savechangespfp-btn'])) {
    //profile image name gets given time_originalname format
    $profileImageName = time() . '_' . $_FILES['profileImage']['name'];
    // folder where it's moved;
    $target = 'users/autoimages/' . $profileImageName;
    //if moving it works/doesn't work;
    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $target)) {
        // gets the user id from the $_SESSION array;
        $useridpfp = $_SESSION['id'];
        // updates the database with $profileImageName for table user_info where userid is $useridpfp
        $sql = "UPDATE `user_info` SET `pfp` = 'users/autoimages/$profileImageName' WHERE `user_info`.`id` = $useridpfp";
        // if it works, update session and redirect to profile page
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            $_SESSION['pfp']="users/autoimages/$profileImageName";
            header('location: index.php?profile=' . $_SESSION['username']);
            exit();
            // if it didn't, display that it didn't (database error)
        } else {
            $msg = "Database Error: Failed to upload the image";
            $css_class = "alert-danger";
        }
        //if it cannot process the file, display that it couldn't upload the image
    } else {
        $msg = "Failed to upload the image";
        $css_class = "alert-danger";
    }
}
