<?php

$username = "root";
$hostname = "127.0.0.1";
$password = "";
$db_name = "event_calendar";

$connect = new mysqli($hostname, $username, $password, $db_name);

function cleanInput($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
};

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
};
