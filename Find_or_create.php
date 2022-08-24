<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
                $conn = new mysqli("localhost","root","","fia3_website");

                $id = $_GET['user_id'];
            ?>
</head>
<body>
    <form name="submitForm" action="Find_or_create.php?user_id=<?php echo $id?>" method="POST">
        <label for="">sport</label>
        <select name="sport_id" id="">
            <?php
                $sql = "SELECT * FROM `sport`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sport_id = $row["sport_id"];
                        $sport_name = $row["sport_name"];
                        echo "<option value='$sport_id'>$sport_name</option>";
                    }
                }
            ?>
        </select>
        <br>
        <label for="">Match to a game</label>
        <select name="find_create" id="">
            <option value="find">Find a game</option>
            <option value="create">Create a match</option>
        </select>
        <br>
        <input type="submit" name="submit" value="submit" />
    </form>
    <a href="info.php?user_id=<?php echo $id?>">back</a>
</body>
</html>