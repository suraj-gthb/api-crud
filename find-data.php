<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode("php://input", true);

include 'db-config.php';

$id = (isset($_GET['id'])) ? $_GET['id'] : $data['id'];

$sql = "select * from tbl_student where id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode(["Status" => true, "Student" => $row]);
} else {
    echo json_encode(["Status" => false, "Message" => "Record Not Found!"]);
}
?>