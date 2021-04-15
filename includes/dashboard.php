<?php
session_start();
include "databse_con.php";
include "helper.php";

$valid_form = false;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'image_update') {
    $ext = pathinfo($_FILES["profileImage"]["name"], PATHINFO_EXTENSION);
    $valid_ext = array("png", "jpg", "jpeg", "gif");

    if(!in_array(strtolower($ext), $valid_ext)){
        $response['message'] = "Invalid image file extension.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../assets/images/profile/";
    $target_file = $target_dir . basename($profileImageName);

    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 2000000) {
        $response['message'] = "Image size should not be greater than 2Mb";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
    // check if file exists
    if(file_exists($target_file)) {
        $response['message'] = "File already exists";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
    // Upload image only if no errors
    if (empty($error)) {
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            $sql = "UPDATE bruker SET img_url='$profileImageName' WHERE id='".$_SESSION['user_id']."'";
            if(mysqli_query($conn, $sql)){
                $_SESSION['img_url'] = $profileImageName;

                $response['img_url'] = $profileImageName;
                $response['message'] = "Image uploaded and saved in the Database";
                $response['status'] = 'SUCCESS';
                echo json_encode($response);
                exit();
            } else {
                $response['message'] = "There was an error in the database";
                $response['status'] = 'FAILED';
                echo json_encode($response);
                exit();
            }
        }
        else {
            $response['message'] = "There was an error uploading the file";
            $response['status'] = 'FAILED';
            echo json_encode($response);
            exit();
        }
    }
}

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'change_password') {
    $valid_form = false;

    if (isset($_POST['password']) && isset($_POST['re_password'])) {
        $valid_form = true;
        $pass = $_POST['password'];
        $re_pass = $_POST['re_password'];
    }

    if (!$valid_form) {
        $response['message'] = "Invalid request data.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    if ($pass !== $re_pass) {
        $response['message'] = "The confirmation password  does not match.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    // hashing the password using SHA1 with Salt
    $pass = sha1($pass . $salt);
    $sql = "SELECT * FROM bruker WHERE id='".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if($row['passord'] == $pass){
            $response['message'] = "You are not allowed to use the same password.";
            $response['status'] = 'FAILED';
            echo json_encode($response);
            exit();
        }

        $sql = "UPDATE bruker SET passord='$pass' WHERE id='".$_SESSION['user_id']."'";
        $result = mysqli_query($conn, $sql);

        if ($result){
            $response['message'] = "Your password has been created successfully changed.";
            $response['status'] = 'SUCCESS';
            echo json_encode($response);
            exit();
        }else {
            $response['message'] = "Change password failed.";
            $response['status'] = 'FAILED';
            echo json_encode($response);
            exit();
        }
    }
    else {
        $response['message'] = "Invalid account.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
}

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'add_candidate') {
    $valid_form = false;

    if (isset($_FILES['profileImage']) && isset($_POST['fakultet']) && isset($_POST['institutt']) && isset($_POST['informasjon']) && isset($_POST['bruker']) && isset($_POST['bruker_epost'])) {
        $valid_form = true;
    }

    $fakultet = validate($_POST['fakultet']);
    $institutt = validate($_POST['institutt']);
    $informasjon = validate($_POST['informasjon']);
    $bruker = validate($_POST['bruker']);
    $bruker_epost = validate($_POST['bruker_epost']);

    $ext = pathinfo($_FILES["profileImage"]["name"], PATHINFO_EXTENSION);
    $valid_ext = array("png", "jpg", "jpeg", "gif");

    $error = true;
    $error_mess = "";

    if (empty($ext)) {
        $error_mess = "Image is required";
    } else if (empty($fakultet)) {
        $error_mess = "Fakultet is required";
    } else if (empty($institutt)) {
        $error_mess = "Institutt is required";
    } else if (empty($informasjon)) {
        $error_mess = "Informasjon is required";
    } else if (empty($bruker)) {
        $error_mess = "Bruker is required";
    } else if (empty($bruker_epost)) {
        $error_mess = "Bruker epost is required";
    } else {
        $error = false;
    }

    if($error){
        $response['message'] = $error_mess;
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    if(!in_array(strtolower($ext), $valid_ext)){
        $response['message'] = "Invalid image file extension.";
        $response['status'] = 'FAILED';
        echo json_encode($ext);
        exit();
    }

    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../assets/images/profile/";
    $target_file = $target_dir . basename($profileImageName);

    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 2000000) {
        $response['message'] = "Image size should not be greater than 2Mb";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
    // check if file exists
    if(file_exists($target_file)) {
        $response['message'] = "File already exists";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    $sql = "SELECT * FROM kandidat WHERE bruker_epost='$bruker_epost'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $response['message'] = $bruker_epost . ' is already existed in kandidat list.';
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    } else {
        $kandidatcol = rand(1111111111,9999999999);
        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);
        
        $sql2 = "INSERT INTO kandidat(fakultet, institutt, informasjon, kandidatcol, stemmer, bruker_epost, bruker, img_url) VALUES ('$fakultet', '$institutt', '$informasjon', '$kandidatcol', 0, '$bruker_epost', '$bruker', '$profileImageName')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            $response['message'] = 'Your candidate has been created successfully';
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

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'add_candidate_me') {
    $valid_form = false;

    if (isset($_POST['fakultet']) && isset($_POST['institutt']) && isset($_POST['informasjon'])) {
        $valid_form = true;
    }

    $fakultet = validate($_POST['fakultet']);
    $institutt = validate($_POST['institutt']);
    $informasjon = validate($_POST['informasjon']);
    $bruker = validate($_SESSION['fname'] . ' ' .$_SESSION['lname']);
    $bruker_epost = validate($_SESSION['email']);

    $error = true;
    $error_mess = "";

    if (empty($fakultet)) {
        $error_mess = "Fakultet is required";
    } else if (empty($institutt)) {
        $error_mess = "Institutt is required";
    } else if (empty($informasjon)) {
        $error_mess = "Informasjon is required";
    } else if (empty($bruker)) {
        $error_mess = "Bruker is required";
    } else if (empty($bruker_epost)) {
        $error_mess = "Bruker epost is required";
    } else {
        $error = false;
    }

    if($error){
        $response['message'] = $error_mess;
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    $profileImageName = $_SESSION['img_url'];

    $sql = "SELECT * FROM kandidat WHERE bruker_epost='$bruker_epost'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $response['message'] = $bruker_epost . ' is already existed in kandidat list.';
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    } else {
        $kandidatcol = rand(1111111111,9999999999);
        
        $sql2 = "INSERT INTO kandidat(fakultet, institutt, informasjon, kandidatcol, stemmer, bruker_epost, bruker, img_url) VALUES ('$fakultet', '$institutt', '$informasjon', '$kandidatcol', 0, '$bruker_epost', '$bruker', '$profileImageName')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            $response['message'] = 'Your candidate has been created successfully';
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

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'get_candidate') {
    $sql = "SELECT * FROM kandidat order by id desc";
    $result = mysqli_query($conn, $sql);

    $res = [];
    $emparray = array();
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $row['allow_edit'] = false;
            if(isset($_SESSION['email']) and $row['bruker_epost'] == $_SESSION['email']){
                $row['allow_edit'] = true;
            }
            $emparray[] = $row;
        }

        $res['total_count'] = mysqli_num_rows($result);
        $res['candidate_list'] = $emparray;

        echo json_encode($res);
    }
    else{
        $res['total_count'] = 0;
        $res['candidate_list'] = [];

        echo json_encode($res);
    }
}

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'get_candidate_me') {
    $sql = "SELECT * FROM kandidat WHERE bruker_epost = '". $_SESSION['email'] ."' order by id desc";
    $result = mysqli_query($conn, $sql);

    $res = [];
    $emparray = array();
    if(mysqli_num_rows($result) > 0) {
        while($row =mysqli_fetch_assoc($result)){
            $emparray[] = $row;
        }

        $res['total_count'] = mysqli_num_rows($result);
        $res['candidate_list'] = $emparray;

        echo json_encode($res);
    }
    else{
        $res['total_count'] = 0;
        $res['candidate_list'] = [];

        echo json_encode($res);
    }
}

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'update_candidate_me') {
    $valid_form = false;

    if (isset($_POST['fakultet']) && isset($_POST['institutt']) && isset($_POST['informasjon']) && isset($_POST['kandidat_id'])) {
        $valid_form = true;
    }

    $fakultet = validate($_POST['fakultet']);
    $institutt = validate($_POST['institutt']);
    $informasjon = validate($_POST['informasjon']);
    $kandidat_id = validate($_POST['kandidat_id']);

    $error = true;
    $error_mess = "";

    if (empty($fakultet)) {
        $error_mess = "Fakultet is required";
    } else if (empty($institutt)) {
        $error_mess = "Institutt is required";
    } else if (empty($informasjon)) {
        $error_mess = "Informasjon is required";
    } else {
        $error = false;
    }

    if($error){
        $response['message'] = $error_mess;
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    $sql = "UPDATE kandidat SET fakultet='$fakultet',institutt='$institutt',informasjon='$informasjon'  WHERE bruker_epost='".$_SESSION['email']."' and id='$kandidat_id'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $response['message'] = "Your kandidat Informasjon is successfully updated.";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
        exit();
    }else {
        $response['message'] = "Change password failed.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
}

else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'withdraw_candidate_me') {
    $sql = "DELETE FROM kandidat WHERE bruker_epost = '". $_SESSION['email'] ."'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $response['message'] = "You successfully withraw from the candidacy";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
    }
    else{
        $response['message'] = "You failed to withraw from the candidacy";
        $response['status'] = 'FAILED';
        echo json_encode($response);
    }
} else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'do_vote') {
    $candidateid = validate($_POST['candidateid']);
    $startforslag = validate($_POST['startforslag']);
    $sluttforslag = validate($_POST['sluttforslag']);
    $startvalg = validate($_POST['startvalg']);
    $sluttvalg = validate($_POST['sluttvalg']);
    $informasjon = validate($_POST['informasjon']);
    $sql2 = "INSERT INTO valg(idvalg, candidateid, startforslag, sluttforslag, startvalg, sluttvalg, information, kontrollert) VALUES (0, '$candidateid', '$startforslag', '$sluttforslag', '$startvalg', '$sluttvalg', '$informasjon', '')";
    $result = mysqli_query($conn, $sql2);

    if($result){
        $response['message'] = "You successfully voted this candidate";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
    }
    else{
        $response['message'] = "You failed to vote";
        $response['status'] = 'FAILED';
        echo json_encode($response);
    }
} else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'get_users') {
    $sql = "SELECT * FROM bruker where brukertype_id != 1 order by id desc";
    $result = mysqli_query($conn, $sql);

    $res = [];
    $emparray = array();
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $emparray[] = $row;
        }

        $res['total_count'] = mysqli_num_rows($result);
        $res['user_list'] = $emparray;

        echo json_encode($res);
    }
    else{
        $res['total_count'] = 0;
        $res['user_list'] = [];

        echo json_encode($res);
    }
} else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'update_userrole') {
    $userid = validate($_POST['userid']);
    $usertype_id = validate($_POST['usertype']);
    $usertype = "";
    if($usertype_id == "1") {
        $usertype = "Administrator";
    } else if ($usertype_id == "2") {
        $usertype = "Candidates";
    } else if ($usertype_id == "3") {
        $usertype = "Voters";
    } else {
        $usertype = "Controllers";
    }
    $error = true;
    $error_mess = "";

    if (empty($userid)) {
        $error_mess = "Bruker is required";
    } else if (empty($usertype)) {
        $error_mess = "User type is required";
    } else {
        $error = false;
    }

    if($error){
        $response['message'] = $error_mess;
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }

    $sql = "UPDATE bruker SET brukertype_id='$usertype_id ',brukertype='$usertype' WHERE id='".$userid."'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $response['message'] = "Your bruker type is successfully updated.";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
        exit();
    }else {
        $response['message'] = "Change bruker type failed.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
} else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'get_valg') {
    $sql = "SELECT * FROM valg INNER JOIN kandidat ON valg.candidateid = kandidat.id";
    $result = mysqli_query($conn, $sql);

    $res = [];
    $emparray = array();
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $emparray[] = $row;
        }

        $res['total_count'] = mysqli_num_rows($result);
        $res['valg_list'] = $emparray;

        echo json_encode($res);
    }
    else{
        $res['total_count'] = 0;
        $res['valg_list'] = [];

        echo json_encode($res);
    }
    exit;
} else if(isset($_POST['endpoint']) && $_POST['endpoint'] == 'add_election') {
    $title = validate($_POST['title']);
    $startvalg = validate($_POST['startvalg']);
    $sluttvalg = validate($_POST['sluttvalg']);
    $informasjon = validate($_POST['informasjon']);
    $sql2 = "INSERT INTO duration(id,startvalg, sluttvalg, title, description) VALUES (0, '$startvalg', '$sluttvalg', '$title', '$informasjon')";
    
    $result = mysqli_query($conn, $sql2);

    if($result){
        $response['message'] = "You successfully added election";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
    }
    else{
        $response['message'] = "You failed to add election";
        $response['status'] = 'FAILED';
        echo json_encode($response);
    }
    exit;
} else if (isset($_POST['endpoint']) && $_POST['endpoint'] == 'get_election') {
    $sql = "SELECT * FROM duration order by id desc";
    $result = mysqli_query($conn, $sql);

    $res = [];
    $emparray = array();
    if(mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            $emparray[] = $row;
        }

        $res['total_count'] = mysqli_num_rows($result);
        $res['election_list'] = $emparray;

        echo json_encode($res);
    }
    else{
        $res['total_count'] = 0;
        $res['election_list'] = [];

        echo json_encode($res);
    }
} else if(isset($_POST['endpoint']) && $_POST['endpoint'] == 'candidate_information') {
    $id = $_POST['id'];
    $info = $_POST['informasjon'];
    $sql = "UPDATE kandidat SET informasjon='$info'  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $response['message'] = "Your kandidat Informasjon is successfully updated.";
        $response['status'] = 'SUCCESS';
        echo json_encode($response);
        exit();
    }else {
        $response['message'] = "Failed.";
        $response['status'] = 'FAILED';
        echo json_encode($response);
        exit();
    }
}



