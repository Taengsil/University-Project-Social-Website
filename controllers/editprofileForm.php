<?php

require_once 'config/db.php';
$msg = "";
$css_class = "";
$bio = "";
// if button is clicked
if (isset($_POST['savechanges-btn'])) {
        $bio=$_POST['bio'];
        // gets the user id from the $_SESSION array;
        $useridpf = $_SESSION['id'];
        // updates the database with $bio for table user_info where userid is $useridpf
        $sql = "UPDATE `user_info` SET `bio` = '$bio' WHERE `user_info`.`id` = $useridpf";
        // if it works, redirect to profile page
    if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            $_SESSION['bio']=$bio;
            header('location: index.php?profile=' . $_SESSION['username']);
            exit();
            // if it didn't, display that it didn't (database error)
    } else {
            $msg = "Database Error: Failed to save the changes.";
            $css_class = "alert-danger";
    }
}

