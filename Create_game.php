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

</head>
<body>
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");
        $id = $_GET['user_id'];
        $sport_id = $_GET['sport_id'];

        if (isset($_POST['time']) && isset($_POST['city'])){
            $time = $_POST['time'];
            $city = $_POST['city'];
            
            echo $time;
            echo $city;

            $sql = "SELECT `sport_level` FROM `skill` WHERE `user_id`= $id AND `sport_id` = $sport_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sport_level = $row["sport_level"];
                }
            };

            $sql = "SELECT * FROM `game` WHERE `sport_id`=$sport_id AND `city`='$city' AND `time`='$time'";
            $result = $conn->query($sql);
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO `game`(`sport_id`, `sport_average_level`,`participate_number`, `city`, `time`) VALUES ('$sport_id','$sport_level',1,'$city','$time')";
                $result = $conn->query($sql);

                $sql = "select * from `game` order by `game_id` desc limit 1;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $game_id = $row["game_id"];
                    }
                }
                $sql = "INSERT INTO `participate`(`user_id`, `sport_id`, `sport_level`, `game_id`) VALUES ('$id','$sport_id','$sport_level','$game_id')";
                $result = $conn->query($sql);

                header("Location: join_game_success.php?user_id=$id");
            }
            else {
                echo "game already set please set another one";
            }
        }

        $sql = "SELECT `sport_name` FROM `sport` WHERE `sport_id` = $sport_id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sport_name = $row["sport_name"];
            }
        }
        $sql = "SELECT `city` FROM `user` WHERE `user_id` = $id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $city = $row["city"];
            }
        }

    ?>

    <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h3>Your are creating a <?php echo $sport_name?> game</h3>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="Find_or_create.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-danger text-white">back to info page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="card position-absolute top-50 start-50 translate-middle text-center col-4">
            <div class="card-header">
                <h1>Create Your Game</h1>
            </div>
            <div class="card-body">
                <form name="submitForm" class="g-3 needs-validation" action="Create_game.php?user_id=<?php echo $id?>&sport_id=<?php echo $sport_id?>" method="POST">
                    <div class="input-group mb-3">    
                        <label class="input-group-text">Select a time for game</label>
                        <input type="datetime-local" name="time" required>
                    </div>
                    <div class="input-group mb-3">    
                        <label class="input-group-text">input a location for game</label>
                        <input type="text" name="city" value="<?php echo $city;?>" required>
                    </div>
                    <div class="invalid-feedback">
                            Please set session date
                        </div>
                    <div class="input-group mb-3">   
                        <input type="submit" name="submit" value="submit"/>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="Find_or_create.php?user_id=<?php echo $id?>" class="btn btn-danger">cancel</a>
            </div>
</body>
</html>