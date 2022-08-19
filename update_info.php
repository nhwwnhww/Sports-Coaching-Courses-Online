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

    <h1>update info</h1>
    <form name="submitForm" action="update_info.php?user_id=<?php echo $id?>" method="POST">
        <input type="text" class="input" placeholder="username" name="username" value="<?php $username?>">
        <input type="text" class="input" placeholder="password" name="password" value="<?php $password?>">
        <input type="text" class="input" placeholder="city" name="city" value="<?php $city?>">
        <input type="text" class="input" placeholder="email" name="email" value="<?php $email?>">
        <input type="text" class="input" placeholder="age" name="age" value="<?php $age?>">
        <input type="text" class="input" placeholder="phone" name="phone" value="<?php $phone?>">
        <button class="button" type="submit">update</button>
    </form>

</body>
</html>