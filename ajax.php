<?php
global $connection;
include 'connection.php';
session_start();
$use_id = $_SESSION['user_id'];


if (($_POST['code']) == 101){

    $user_list = "SELECT * FROM users WHERE  user_id <> '$use_id'";
    $user_list_query = mysqli_query($connection,$user_list);
    $arr = [];
    while ($row = mysqli_fetch_assoc($user_list_query)) {

        array_push($arr, $row);
    }

    echo json_encode($arr);
}