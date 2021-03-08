<?php
session_start();
include "databse_con.php";
include "helper.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'login') {
    if (isset($_POST['epost']) && isset($_POST['password'])) {
        $epost = validate($_POST['epost']);
        $pass = $_POST['password'];
        if (empty($epost) || empty($pass)) {
            $response['message'] = "Fyll inn feltet";
            $response['status'] = 'FAILED';
            echo json_encode($response);
            exit();
        }
        else {
            $encrypted_pass = sha1($pass . $salt);
            $sql = "SELECT * FROM bruker WHERE epost='$epost' AND passord='$encrypted_pass'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['email'] = $row['epost'];
                $_SESSION['fname'] = $row['fnavn'];
                $_SESSION['lname'] = $row['enavn'];
                $_SESSION['brukertype'] = $row['brukertype'];
                $_SESSION['brukertype_id'] = $row['brukertype_id'];
                $_SESSION['img_url'] = $row['img_url'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['logged_in'] = true;

                $response['message'] = "Login success, Please wait";
                $response['status'] = 'SUCCESS';
                echo json_encode($response);
                exit();
            } else {
                $response['message'] = "Sjekk Brukernavn eller Passord";
                $response['status'] = 'FAILED';
                echo json_encode($response);
                exit();
            }
        }
    }
    else {
        $response['message'] = "Sjekk Brukernavn eller Passord";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
}
?>