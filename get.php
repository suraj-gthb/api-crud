<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode("php://input", true);

include 'db-config.php';

if (!isset($_GET['apikey']) || $_GET['apikey'] == '') {
    echo json_encode(["Status" => false, "Message" => "Please provide API key!", "Code" => "0"]);
} else {

    $apikey = $_GET['apikey'];

    $sql_api = "select `api_key` from `tbl_apikeys` where `api_key` = '$apikey'";
    $result = mysqli_query($conn, $sql_api);
    if (mysqli_num_rows($result) > 0) {
        //================if api key is find then return data===============
        $sql = "select * from tbl_student order by id asc";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode(["Status" => true, "Message" => "Number of student(s) found: " . $count, "Students" => $row]);
        } else {
            echo json_encode(["Status" => false, "Message" => "Record Not Found!"]);
        }
        //===================================
    } else {
        echo json_encode(["Status" => false, "Message" => "API key is invalid!", "Code" => "1"]);
    }
}
