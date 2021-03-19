<?php

$conn = new mysqli('localhost', 'root', '', 'user-verification');

if ($conn->connect_error){
    die('Database error:' . $conn->connect_error);
}

?>