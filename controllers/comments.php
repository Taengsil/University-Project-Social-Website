<?php

require_once 'controllers/authController.php';
require 'config/db.php';
require 'profile.php';

$postinguserid = '';
$receivinguserid = '';
$date = '';
$commenttext = '';


if (isset($_POST['comment-post-btn'])) {
    // alocarea valorilor pentru fiecare variabila
    $postinguserid = $_SESSION['id']; // utilizatorul (id) logat 
    $receivinguserid = $user2['id']; // utilizatorul (id) a carui pagini este deschisa
    $date = date("Y-m-d-H-i-s"); // data
    $commenttext = $_POST['comment-post']; // textul comentariului
    $posterusername = $_SESSION['username']; // utilizatorul (nume) logat
    $posterrealname = $_SESSION['realname']; // utilizatorul (nume) a carui pagini este deschisa
    if (!empty($commenttext)) {
        // inserarea (nesecurizata) in baza de date a variabilelor
        $sql = "INSERT INTO comments (postinguserid, postingusername, postingrealname, receivinguserid, date, commenttext) 
                        VALUES('$postinguserid', '$posterusername', '$posterrealname', '$receivinguserid', '$date', '$commenttext')";
        if ($conn->query($sql) === TRUE) {
            header('location: index.php?profile=' . $user2['username']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
