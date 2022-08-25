<?php
    $conn = new mysqli("localhost","root","","fia3_website");

    $id = $_GET['user_id'];

    if (isset($_POST["username"])){
        $update_username = $_POST["username"];
        $update_password = $_POST["password"];
        $update_city = $_POST["city"];
        $update_email = $_POST["email"];
        $update_age = $_POST["age"];    
        $update_phone = $_POST["phone"];

        $update_sql = "UPDATE `user` SET `username`='$update_username',`password`='$update_password',`city`='$update_city',`email`='$update_email',`age`='$update_age',`phone`='$update_phone' WHERE `user_id` = '$id'";
        $update_result = $conn->query($update_sql);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>

    <!-- user info model -->
    <link rel="stylesheet" href="./css/user_info.css">
</head>
<body class="bg-dark" style="overflow-x: hidden;">
    <div class="row">
    <!-- left part -->
    <div class="col container p-5 my-5 bg-dark text-dark">
<?php
    $conn = new mysqli("localhost","root","","fia3_website");

    $id = $_GET['user_id'];

    $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
            $username = $row["username"];
            $password = $row["password"];
            $img_url = $row["img_url"];
            $city = $row["city"];
            $email = $row["email"];
            $age = $row["age"];
            $phone = $row["phone"];

        }
    }
    ?>
    <div class='card-wrapper'>
        <div class='main-window' id='main-window'>

            <div class='user-image' style="background-image: url('<?php echo $img_url?>');">
                <div class='username'><?php echo $username;?></div>
            </div>
            <div class='user-info'>
                <div class='quote'>Email: <?php echo $email?></div>
                <div class='quote'>Age: <?php echo $age;?></div>
                <div class='quote'>Phone: <?php echo $phone;?></div>
                <div class='quote'>City: <?php echo $city;?></div>
            </div>

        </div>
    </div>
</div>

 <div class="col container p-5 my-5 bg-light text-dark" style="flex-direction: column;">
    <!-- right part -->
    <p class="display-1">update info</p>
    <br>
    <form name="submitForm" action="update_info.php?user_id=<?php echo $id?>" method="POST" enctype="multipart/form-data">
        <label class="form-label">username:</label>
        <input type="text" class="input form-control" placeholder="username" name="username" value="<?php echo $username?>">
        <label class="form-label">password:</label>
        <input type="text" class="input form-control" placeholder="password" name="password" value="<?php echo $password?>">
        <label class="form-label">city:</label>
        <input type="text" class="input form-control" placeholder="city" name="city" value="<?php echo $city?>">
        <label class="form-label">email:</label>
        <input type="text" class="input form-control" placeholder="email" name="email" value="<?php echo $email?>">
        <label class="form-label">age:</label>
        <input type="text" class="input form-control" placeholder="age" name="age" value="<?php echo $age?>">
        <label class="form-label">phone:</label>
        <input type="text" class="input form-control" placeholder="phone" name="phone" value="<?php echo $phone?>">
        <label class="form-label">Change your image:</label>
        <input type="file" name="myfile" class="form-control" accept="image/jpeg,image/gif,image/png"/>
        <br>
        <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
    </form>
    <br>
    <a href="info.php?user_id=<?php echo $id?>" class="btn btn-danger">back</a>
    
    <?php
    if (isset($_FILES['myfile']['name'])){
		$imgname = $_FILES['myfile']['name'];
    $tmp = $_FILES['myfile']['tmp_name'];
    $filepath = "./user_img/";
    if(move_uploaded_file($tmp,$filepath.$imgname.".png")){
        // echo "upload img success";
        $update_img_sql = "UPDATE `user` SET `img_url`='$filepath$imgname.png' WHERE `user_id` = $id ";
        $update_img_result = $conn->query($update_img_sql);
        header("Location: update_info.php?user_id=$id");
    }else{
        echo "upload img error";
    }
	// echo $tmp;
	// echo '<br>';
	// echo $filepath;
	// echo '<br>';
	// echo $imgname;
	}
?>
</div>
</div>


</body>
</html>