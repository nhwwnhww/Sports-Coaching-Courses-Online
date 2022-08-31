<?php

// check if username exit
if (isset($_POST['username'])){
    $username= $_POST['username'];
    $password= $_POST['password'];

    echo $username;
    echo $password;

    $conn = new mysqli("localhost","root","","fia3_website");
    
    $sql = "";
    $result = $conn->query($sql);
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
    <form action="./ex.php" method="post">
        <label for="">name</label>
        <input type="text" name="username">

        <label for="">password</label>
        <input type="text" name="password">

        <input type="submit" value="submit">

    </form>
</body>
</html>