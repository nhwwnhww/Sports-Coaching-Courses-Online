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
</head>
<body>
<?php
        
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

                echo $user_id;
                echo '<br>';
                echo $username;
                echo '<br>';
                echo $password;
                echo '<br>';
                echo $img_url;
                echo '<br>';
                echo $city;
                echo '<br>';
                echo $email;
                echo '<br>';
                echo $age;
                echo '<br>';
                echo $phone;

            }
        }
    ?>
    <img src="<?php echo $img_url?>" alt="" width="75px">


    <h1>update info</h1>
    <form name="submitForm" action="update_info.php?user_id=<?php echo $id?>" method="POST" enctype="multipart/form-data">
        <input type="text" class="input" placeholder="username" name="username" value="<?php echo $username?>">
        <input type="text" class="input" placeholder="password" name="password" value="<?php echo $password?>">
        <input type="text" class="input" placeholder="city" name="city" value="<?php echo $city?>">
        <input type="text" class="input" placeholder="email" name="email" value="<?php echo $email?>">
        <input type="text" class="input" placeholder="age" name="age" value="<?php echo $age?>">
        <input type="text" class="input" placeholder="phone" name="phone" value="<?php echo $phone?>">
        <input type="file" name="myfile"  accept="image/jpeg,image/gif,image/png"/>
        <input type="submit" name="submit" value="Upload" />
    </form>

    
    <a href="info.php?user_id=<?php echo $id?>">back</a>
    
    <?php
    if (isset($_FILES['myfile']['name'])){
		$imgname = $_FILES['myfile']['name'];
    $tmp = $_FILES['myfile']['tmp_name'];
    $filepath = "./user_img/";
    if(move_uploaded_file($tmp,$filepath.$imgname.".png")){
        echo "upload img success";
        $update_img_sql = "UPDATE `user` SET `img_url`='$filepath$imgname.png' WHERE `user_id` = $id ";
        $update_img_result = $conn->query($update_img_sql);
    }else{
        echo "upload img error";
    }

    

	echo $tmp;
	echo '<br>';
	echo $filepath;
	echo '<br>';
	echo $imgname;
	}
?>

</body>
</html>