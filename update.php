<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Autorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$id = (isset($_POST['id'])) ? $_POST['id'] : $data['id'];
$name = (isset($_POST['name'])) ? $_POST['name'] : $data['name'];
$email = (isset($_POST['email'])) ? $_POST['email'] : $data['email'];
$mobile = (isset($_POST['mobile'])) ? $_POST['mobile'] : $data['mobile'];

include 'db-config.php';

$sql = "update tbl_student set name='$name', email='$email', mobile='$mobile' where id='$id'";
if(mysqli_query($conn, $sql)) {
    echo json_encode(["Status" => true, "Message" => "Student Data Updated Successfully"]);
}else{
    echo json_encode(["Status" => false, "Message" => "Error : " . mysqli_error($conn)]);
}

?>