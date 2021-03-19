<?php

session_start();

require 'config/db.php';

$errors = array();
$username = "";
$email = "";
$realname = "";
$bio = "This user has not set a bio.";
$pfp = "users/websiteresources/defpfp.jpg";

// daca utilizatorul da click pe butonul de sign up
if (isset($_POST['signup-btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $realname = $_POST['realname'];

    // validare
    if (empty($username)) {
        $errors['username'] = "The username field cannot be empty.";
    }
    if (empty($realname)) {
        $errors['realname'] = "The real name field cannot be empty.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "The email address is invalid.";
    }
    if (empty($email)) {
        $errors['email'] = "The email field cannot be empty.";
    }
    if (empty($password)) {
        $errors['password'] = "The password field cannot be empty.";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "The two passwords do not match.";
    }

    //check if email already exists (email is unique to each account)

    $emailQuery = "SELECT * FROM user_info WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();


    if ($userCount > 0) {
        $errors['email'] = "This email address is already registered.";
    }

    //check if username already exists (username is unique to each account)

    $userQuery = "SELECT * FROM user_info WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $usernameCount = $result->num_rows;
    $stmt->close();

    if ($usernameCount > 0) {
        $errors['takenusername'] = "This username is already registered.";
    }

    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user_info (realname, username, email, password, bio, pfp) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $realname, $username, $email, $password, $bio, $pfp);

        if ($stmt->execute()) {
            // login utilizator
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['realname'] = $realname;
            $_SESSION['bio'] = $bio;
            $_SESSION['pfp'] = $pfp;
            // set flash message
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php?profile=' . $_SESSION['username']);
            exit();
        } else {
            $errors['db_error'] = "Database error: failed to register";
        }
    }
}

// daca utilizatorul da click pe butonul de login
if (isset($_POST['login-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validare
    if (empty($username)) {
        $errors['username'] = "The username field cannot be empty.";
    }
    if (empty($password)) {
        $errors['password'] = "The password field cannot be empty.";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM user_info WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // logare cu succes
            // login utilizator
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['realname'] = $user['realname'];
            $_SESSION['bio'] = $user['bio'];
            $_SESSION['pfp'] = $user['pfp'];
            // set flash message
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php?profile=' . $_SESSION['username']);
            mysqli_close($conn);
            exit();
        } else {
            $errors['login_failed'] = "The username does not match the password.";
        }
    }
}

//logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['realname']);
    unset($_SESSION['bio']);
    unset($_SESSION['pfp']);
    header('location: login.php');
    exit();
}
