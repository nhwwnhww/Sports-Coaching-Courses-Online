<!-- php debug -->
<?php 
    function debug_to_console($data) {
        echo "<script>console.log('Debug log: " . json_encode($data) . "' );</script>";
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

    <link rel="stylesheet" href="./css/user_info.css">

    <?php 
    $conn = new mysqli("localhost","root","","fia3_website");

    $id = $_GET['user_id'];
    ?>

    <?php 
    // user info
        $conn = new mysqli("localhost","root","","fia3_website");

        $id = $_GET['user_id'];
        $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $display_city_required = 'block';
            while ($row = $result->fetch_assoc()) {
                $mentor_user_id = $row["user_id"];
                $mentor_username = $row["username"];
                $mentor_img_url = $row["img_url"];
                $mentor_city = $row["city"];
                $mentor_email = $row["email"];
                $mentor_age = $row["age"];
                $mentor_phone = $row["phone"];

            }
        }
    ?>

    <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h3>Now you are the mentor in Wei's sport hub</h3>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="set_session.php?user_id=<?php echo $id?>" class="nav-item nav-link btn-primary text-white me-3">set a session</a>
                            <a href="info.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-danger text-white">back to info page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    <?php

        // get sport info model

        $sql = "SELECT * FROM `sport`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sport_list = array();
            while ($row = $result->fetch_assoc()) {
                $sport_id = $row["sport_id"];
                $sport_name = $row["sport_name"];
                $img_url = $row["img_url"];

                $temp_array = array($sport_id=>array(
                    'sport_name'=>$sport_name,
                    'img_url'=>$img_url,
                ));                    
                array_push($sport_list, $temp_array);
            }
            // debug_to_console($sport_list);
        }
    ?>

    <?php 
    // get user info
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_list = array();
            while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $username = $row["username"];
                $img_url = $row["img_url"];
                $age = $row["age"];
                $phone = $row["phone"];

                $temp_array = array($user_id=>array(
                    'username'=>$username,
                    'img_url'=>$img_url,
                    'age'=>$age,
                    'phone'=>$phone,));
                array_push($user_list, $temp_array);
            }
            // debug_to_console($user_list);
        }
    ?>
</head>
<body>
<div class="row">
    <div class="col">

    <div class='card-wrapper bg-dark' style="width:500px">
        <div class='main-window bg-dark text-white' id='main-window'>

            <div class='user-image' style="background-image: url('<?php echo $mentor_img_url?>');">
                <div class='username'><?php echo $mentor_username;?></div>
            </div>
            <div class='user-info'>
                <div class='quote'>Email: <?php echo $mentor_email?></div>
                <div class='quote'>Age: <?php echo $mentor_age;?></div>
                <div class='quote'>Phone: <?php echo $mentor_phone;?></div>
                <div class='quote'>City: <?php echo $mentor_city;?></div>
            </div>
        </div>
    </div>

    <?php
        // get user's city
        $sql = "SELECT * FROM `user` WHERE `user_id` = '$id'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $city = $row["city"];
                if ($city == ""){
                    header("Location: info.php?user_id=$id");
                }
            }
        }
        ?>
        </div>
        <div class="col d-flex flex-column ">
        <h1>Your session</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#session">
        Click me to show all session you set
        </button>
        <!-- Modal -->
        <div class="modal fade" id="session" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Your session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
                // get mentor's session
                $sql = "SELECT * FROM `mentor_session` WHERE `mentor_id` = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-hover'>";

                    echo "<tr>
                            <td>Session id</td>
                            <td>Sport name</td>
                            <td>City</td>
                            <td>Date</td>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        $session_id = $row["session_id"];
                        $sport_id = $row["sport_id"];
                        $city = $row["city"];
                        $date = $row["date"];

                        $sport_name = $sport_list[$sport_id-1][$sport_id]["sport_name"];

                        echo "<tr>
                            <th>$session_id</th>
                            <th>$sport_name</th>
                            <th>$city</th>
                            <th>$date</th>
                        </tr>";
                    }
                    echo "</table>";
                }
            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understond</button>
            </div>
            </div>
        </div>
        </div>
    
    <h1>mentee booked</h1>
    <!-- mentee booked Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mentee_booked">
        Click me to show who booked your session
        </button>
        <!-- mentee booked Modal -->
        <div class="modal fade" id="mentee_booked" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Your session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <?php
        $conn = new mysqli("localhost","root","","fia3_website");

        $sql = "SELECT * FROM `book` WHERE `mentor_id` = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped table-hover'>";

                    echo "<tr>
                    <td>Book id</td>
                    <td>mentee name</td>
                    <td>Sport name</td>
                    <td>City</td>
                    <td>Date</td>
                    <td>Feedback</td>
                        </tr>";
            while ($row = $result->fetch_assoc()) {
                $mentee_id = $row["mentee_id"];
                $book_id = $row["book_id"];
                $sport_id = $row["sport_id"];
                $city = $row["city"];
                $date = $row["date"];
                $feedback = $row["feedback"];

                $mentee_name = $user_list[$mentee_id-1][$mentee_id]["username"];
                $sport_name = $sport_list[$sport_id-1][$sport_id]["sport_name"];

                echo "<tr>
                        <th>$book_id</th>
                        <th>$mentee_name</th>
                        <th>$sport_name</th>
                        <th>$city</th>
                        <th>$date</th>
                        <th>$feedback</th>
                    </tr>";
            }
            echo "</table>";
        }
    ?>
    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!!</button>
            </div>
            </div>
        </div>
        </div>
        <br>
    <a href="set_session.php?user_id=<?php echo $id?>" class="btn btn-primary text-white me-3">set a session</a>
    <br>
    <a href="info.php?user_id=<?php echo $id?>" class="btn btn-danger text-white me-3">back</a>
    </div>
    </div>
</body>
</html>