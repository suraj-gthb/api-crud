<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

include 'db-config.php';

$id = (isset($_POST['id'])) ? $_POST['id'] : $data['id'];

if ($id != '') {
    $sql = "delete from tbl_student where id = $id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["Status" => true, "Message" => "Student Data Deleted Successfully!"]);
    } else {
        echo json_encode(["Status" => false, "Message" => "Error : " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["Status" => false, "Message" => "Id Is Required!"]);
}
