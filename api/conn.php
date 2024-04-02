<?php
    $serverName = "Localhost";
    $userName = "owner01";
    $pwd = "123456";
    $dbName = "projectBagel";

    $conn = mysqli_connect($serverName, $userName, $pwd, $dbName);
    if(!$conn){
        echo "連線錯誤";
        die("連線錯誤".mysqli_connect_error());
    }
?>