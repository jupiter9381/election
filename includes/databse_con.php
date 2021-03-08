<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "mydb";

$salt = "IT2_2021";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	$response['message'] = "Connection failed, Please check your database connection.";
    $response['status'] = 'FAILED';
    echo json_encode($response);
	exit();
}

?>