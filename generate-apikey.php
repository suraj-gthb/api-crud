<?php
include 'db-config.php';

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $apikey = random_bytes(16);
    $apikey = bin2hex($apikey);

    $sql = "insert into tbl_apikeys (username, api_key) values ('$username', '$apikey')";
    if(mysqli_query($conn, $sql)){
        echo "Your API Key has been generated successfully!<br>API Key : <b>" . $apikey  . "</b></br>Note this key for access the data.";
    }else{
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate API Key</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>

<body>
    <div class="conatainer">
        <div class="row min-vh-100">
            <div class="col-4 p-3 border m-auto">
                <h5 class="text-center">Generate API Key</h5>
                <form action="" method="post">
                    <div class="form-group mb-3"><label for="">User Name</label><input type="text" name="username" id="" class="form-control"></div>
                    <div class="form-group mb-3"><input type="submit" name="submit" id="" value="Generate API Key" class="btn btn-success"></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>