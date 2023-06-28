<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode("php://input", true);

include 'db-config.php';

$search_key = isset($_GET['search']) ? $_GET['search'] : die("Key is empty");

$sql = "select * from tbl_student where concat(name, email, mobile) like '%{$search_key}%'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
if($count > 0){
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(["Status" => true, "Message" => "Number of student(s) found: ".$count, "Students"=>$row]);
}else{
    echo json_encode(["Status" => false, "Message" => "Record Not Found!"]);
}
