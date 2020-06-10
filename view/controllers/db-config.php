<?php
    $serverName = "127.0.0.1";
    $databaseName = "di_asa"; ;
    $databaseUser = "root";
    $databasePassword = '#4kLxMzGurQ7Z~'; #"#4kLxMzGurQ7Z~";

    $database = mysqli_connect($serverName, $databaseUser, $databasePassword, $databaseName);

    if (!$database) {
        die("unable to connect to database");
    }