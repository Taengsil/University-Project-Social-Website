<?php

// Cautarea unui utilizator

require 'config/db.php';
require_once 'controllers/authcontroller.php';
$searcherrors = array();
$usernamesearch = "";
$user2 = array();
$defaultusername = "";
$commentresults = array();

// daca utilizatorul da click pe butonul de search
if (isset($_GET['profile'])) {
    $usernamesearch = $_GET['profile'];

    if (!empty($usernamesearch)) {
        // cautarea din baza de date dupa numele din $usernamesearch
        $userQuery = "SELECT * FROM user_info WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param('s', $usernamesearch);
        $stmt->execute();
        $result = $stmt->get_result();
        $userCount = $result->num_rows;
        $stmt->close();
        // cautarea utilizatorului cu nume gresit 
        if ($userCount === 0 and !empty($usernamesearch)) {
            $searcherrors['username-not-found'] = "There was no matching username found.";
        }
        // daca nu sunt erori din baza de date si avem username corect in cautare
        if (count($searcherrors) === 0 and !empty($usernamesearch)) {
            $result2 = mysqli_query($conn, "SELECT * FROM user_info WHERE username ='$usernamesearch'");
            $user2 = $result2->fetch_assoc();
            $user2id = $user2['id'];
        } else {
            // altfel, intoarcere la profilul user-ului logat
            $defaultusername = $_SESSION['username'];
            $result2 = mysqli_query($conn, "SELECT * FROM user_info WHERE username ='$defaultusername'");
            $user2 = $result2->fetch_assoc();
            $user2id = $_SESSION['id'];
        }
    } else {
        // cautarea utilizatorului fara nume
        $searcherrors['username-search'] = "The username search field cannot be empty.";
        $defaultusername = $_SESSION['username'];
        $result2 = mysqli_query($conn, "SELECT * FROM user_info WHERE username ='$defaultusername'");
        $user2 = $result2->fetch_assoc();
        $user2id = $_SESSION['id'];
    }
    if (isset($_POST['sort'])) {
        // daca avem tip de sortare postat
        $sorttype = $_POST['sort'];
        $_SESSION['sort'] = $sorttype;
        $sortingtype = $_SESSION['sort'];
        if ($sortingtype == "date") {
            $commentresults = mysqli_query($conn, "SELECT * FROM comments WHERE receivinguserid ='$user2id' ORDER BY $sortingtype DESC");
        }
        else {
            $commentresults = mysqli_query($conn, "SELECT * FROM comments WHERE receivinguserid ='$user2id' ORDER BY $sortingtype ASC");
        }
    }else{
        // altfel, sortarea dupa zi
        $sorttype = "date";
        $_SESSION['sort'] = $sorttype;
        $sortingtype = $_SESSION['sort'];
        $commentresults = mysqli_query($conn, "SELECT * FROM comments WHERE receivinguserid ='$user2id' ORDER BY $sortingtype DESC");
    }
}
