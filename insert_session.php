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
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];
        $city = $_GET['city'];

        $sport = $_POST["sport"];
        $day = $_POST["date"];
        $time = $_POST["time"];
        $date = $day . '-'.$time;

        $sql = "INSERT INTO `mentor_session`(`sport_id`, `mentor_id`, `city`, `date`) VALUES ('$sport','$id','$city','$date')";
        $result = $conn->query($sql);
        header("Location: mentor_info.php?user_id=$id");

        echo $id;
        echo '<br>';
        echo $city;
        echo '<br>';
        echo $sport;
        echo '<br>';
        echo $date;
    ?>
</body>
</html>