<?php
$HostName = "localhost";
$UserName = "root";
$Password = "";
$DB = "web_scrapping";
$Connect_DB = mysqli_connect($HostName, $UserName, $Password);
$sql1 = "CREATE DATABASE `$DB`";
mysqli_query($Connect_DB, $sql1);
$Connect_DB = mysqli_connect($HostName, $UserName, $Password, $DB);

if (!$Connect_DB) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    DataBase Not-Connected -- You should check in C-Panel.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>