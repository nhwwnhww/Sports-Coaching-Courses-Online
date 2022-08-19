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

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];
                $sport_describe = $row["sport_describe"];
                $sport_max_level = $row["sport_max_level"];
                $sport_book_time = $row["sport_book_time"];
                $sport_max_participate = $row["sport_max_participate"];

                echo "<hr>";
                echo $sport_name;
                echo "<br>";
                echo "<img src='$img_url'>";
                echo "<br>";
                echo $sport_describe;
                echo "<br>";
                echo $sport_max_level;
                echo "<br>";
                echo $sport_book_time;
                echo "<br>";
                echo $sport_max_participate;
                echo "<br>";
                echo "<a href='mentor_session.php?user_id=$id&sport_id=$sport_id'>book a $sport_name session</a>";
                echo "<hr>";
            }
        }
    ?>
    <a href="info.php?user_id=<?php echo $id?>">back</a>
</body>
</html>