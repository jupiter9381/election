<?php
session_start();
include "databse_con.php";
include "helper.php";

$valid_form = false;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'register') {
    if (isset($_POST['fnavn']) && isset($_POST['enavn']) && isset($_POST['epost']) && isset($_POST['password']) && isset($_POST['re_password'])) {
        $valid_form = true;
    }

    if (!$valid_form){
        $response['message'] = "The confirmation password  does not match";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    $fnavn = validate($_POST['fnavn']);
    $enavn = validate($_POST['enavn']);
    $epost = validate($_POST['epost']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $gender = validate($_POST['gender']);
    $phone = validate($_POST['phone']);
    $bday = validate($_POST['bday']);

    $error = true;
    $error_mess = "";

    if (empty($epost)) {
        $error_mess = "Email is required";
    } else if (empty($gender)) {
        $error_mess = "Gender is required";
    } else if (empty($phone)) {
        $error_mess = "Phone number is required";
    } else if (empty($bday)) {
        $error_mess = "Birthdate is required";
    } else if (empty($pass)) {
        $error_mess = "Password is required";
    } else if (empty($re_pass)) {
        $error_mess = "Re Password is required";
    } else if (empty($fnavn) || empty($enavn)) {
        $error_mess = "Name is required";
    } else if ($pass !== $re_pass) {
        $error_mess = "The confirmation password  does not match";
    } else {
        $error = false;
    }

    if($error){
        $response['message'] = $error_mess;
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }


    // hashing the password using SHA1 with Salt
    $pass = sha1($pass . $salt);
    $sql = "SELECT * FROM bruker WHERE epost='$epost'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $response['message'] = 'The username is taken try another';
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    } else {
        $sql2 = "INSERT INTO bruker(fnavn, enavn, epost, passord, brukertype, brukertype_id, img_url, gender, phone, bday) VALUES ('$fnavn', '$enavn', '$epost', '$pass', 'Voters', 3, 'avatar.jpeg', '$gender', '$phone', '$bday')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            $response['message'] = 'Du har opprettet en bruker !';
            $response['status'] = 'SUCCESS';
            echo json_encode($response);
            exit();
        }else {
            $response['message'] = 'unknown error occurred';
            $response['status'] = 'FAILED';
            echo json_encode($response);
            exit();
        }
    }
}
