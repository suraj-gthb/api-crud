<?php
header('Content-Type: application/json'); //return type
header('Access-Control-Allow-Origin: *'); // who can access this
header('Access-Control-Allow-Methods: POST'); // use POST method
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //

$data = json_decode(file_get_contents("php://input"), true); //read all row data like json, xml
include 'db-config.php';


$name = (isset($_POST['name'])) ? $_POST['name'] : $data['name'];
$email = (isset($_POST['email'])) ? $_POST['email'] : $data['email'];
$mobile = (isset($_POST['mobile'])) ? $_POST['mobile'] : $data['mobile'];

if ($name != '') {
    if ($email != '') {
        if ($mobile != '') {
            $sql = "insert into tbl_student (name, email, mobile) values('{$name}', '{$email}', '{$mobile}')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(['Status' => true, 'Message' => 'Data Inserted Successfully!']);
            } else {
                echo json_encode(['Status' => false, 'Message' => 'Data Not Inserted!']);
            }
        } else {
            echo json_encode(['Status' => false, 'Message' => 'Mobile is required!']);
        }
    } else {
        echo json_encode(['Status' => false, 'Message' => 'Email is required!']);
    }
} else {
    echo json_encode(['Status' => false, 'Message' => 'Name is required!']);
}
?>