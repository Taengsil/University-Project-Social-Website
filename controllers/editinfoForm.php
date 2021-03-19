<?php

require_once 'controllers/authController.php';
require_once 'config/db.php';

$errors = array();
$msg = "";
$css_class = "";
$newusername = "";
$newrealname = "";
$newemail = "";

// if button is clicked
if (isset($_POST['savechanges-btn'])) {
    $newrealname = $_POST['realname'];
    $newusername = $_POST['username'];
    $newemail = $_POST['email'];
    // gets the user id from the $_SESSION array;
    $useridpf = $_SESSION['id'];

    //daca exista deja numele dorit si apartine unui user diferit
    $userQuery = "SELECT * FROM user_info WHERE username=? LIMIT 1";
    if($stmt = $conn->prepare($userQuery)){
        $stmt->bind_param('s', $newusername);
        $stmt->execute();
        $result = $stmt->get_result();
        $usernameCount = $result->num_rows;
        $stmt->close();
    } else{
        $mysqlerror = $conn->errno . ' ' . $conn->error;
        echo $mysqlerror; 
    }

    if (($usernameCount > 0) && ($newusername != $_SESSION['username']) ){
        $errors['1'] = "This username is already registered.";
    }

    //daca exista deja adresa de email dorita si apartine unui user diferit
    $emailQuery = "SELECT * FROM `user_info` WHERE `email`=? LIMIT 1";
    if ($stmt = $conn->prepare($emailQuery)){
        $stmt->bind_param('s', $newemail);
        $stmt->execute();
        $result = $stmt->get_result();
        $emailCount = $result->num_rows;
        $stmt->close();
    } else{
        $mysqlerror = $conn->errno . ' ' . $conn->error;
        echo $mysqlerror; 
    }

    if (($emailCount > 0) && ($newemail != $_SESSION['email'])) {
        $errors['3'] = "This email is already registered.";
    }

    // if no errors, update tables;
    if (count($errors) === 0) {
        //update user
        $updateUserInfoQuery = "UPDATE `user_info` SET `realname` = ?, `username` = ?, `email` = ? WHERE `user_info`.`id` = ?";
        if ($stmt = $conn->prepare($updateUserInfoQuery)){
            $stmt->bind_param('sssd', $newrealname, $newusername, $newemail, $useridpf); ///
            $stmt->execute();
            $stmt->close();
        } else {
            $errors[5] = "Database Error: Failed to reflect the changes on user.";
        }
        $_SESSION['username']=$newusername;
        $_SESSION['realname']=$newrealname;
        $_SESSION['email']=$newemail;
        //update comments
        $updateCommentsInfoQuery = "UPDATE `comments` SET `postingusername` = ?, `postingrealname` = ?, WHERE `comments`.`postinguserid` = ?";
        if ($stmt = $conn->prepare($updateCommentsInfoQuery)){
            $stmt->bind_param('ssd', $newusername, $newrealname, $useridpf); ///
            $stmt->execute();
            $stmt->close;
        } else {
            $errors[7] = "Database Error: Failed to reflect the changes on user's comments.";
        }
        if (count($errors) === 0) {
            header('location: index.php?profile='.$_SESSION['username']);
            exit();
        }
    }
}

