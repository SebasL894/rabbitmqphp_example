#!/usr/bin/php
<?php

$db1 = 'mysql';
$db2 = 'it490';
$mydb = new mysqli('10.147.17.52','Sebas','IT490','authorizationdb');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database: ".$db1.PHP_EOL;

$checkuser = 'Sebas';

$nquery = "select user from user where user = ?";
$stmt = $mydb->prepare($nquery);
$stmt->bind_param("s", $checkuser);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "User: $checkuser exists\n";
} else {
        echo "User dont exist\n";
}

$mydb->close();

$mydb = new mysqli('10.147.17.52','Sebas','IT490','authorizationdb');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database: ".$db2.PHP_EOL;


$query = "create table if not exists users(
    user_id int primary key auto_increment,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) not null unique,
    password_hash varchar(60) not null,
    created_at timestamp default current_timestamp
    )";
if ( $mydb->query($query)== TRUE){
    echo "table created succesfully\n";
} else {
    echo "Error: " . $mydb->error;
}

?>