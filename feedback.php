<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <?php
        $id = $_GET['user_id'];
        $book_id = $_GET['book_id'];
        $mentor_name = $_GET['mentor_name'];
        $sport_name = $_GET['sport_name'];
        $city = $_GET['city'];
        $date = $_GET['date'];
    ?>

    <?php
    $conn = new mysqli("localhost","root","","fia3_website");
    
    // echo $post_feedback;
    
    if (isset($_POST["feedback"])){
        $post_feedback = $_POST["feedback"];
        $sql = "UPDATE `book` SET `feedback`='$post_feedback' WHERE `book_id` = '$book_id'";
        $result = $conn->query($sql);
        header("Location: info.php?user_id=$id");  
    }
    ?>

</head>
<body>

<div class="m-4" id="nev">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h1>Wei's sport hub</h1>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="./info.php?user_id=<?php echo $id?>" class="btn btn-danger float-end" class="nav-item nav-link" tabindex="-1">Cancel</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <form action="./feedback.php?<?php echo "book_id=$book_id&user_id=$id&mentor_name=$mentor_name&sport_name=$sport_name&city=$city&date=$date"?>" method="post">
        <div class="col-8 position-absolute top-50 start-50 translate-middle">
        <h1 style="text-align: center;">Add a feedback to your Mentor</h1>

            <!-- book -->
            <?php
                echo "<table class='table table-striped table-hover'>
                <tr>
                    <th>book_id</th>
                    <th>mentor_name</th>
                    <th>sport_name</th>
                    <th>city</th>
                    <th>date</th>
                </tr>";

                    echo "<tr>";
                    echo "<td>".$book_id."</td>";
                    echo "<td>".$mentor_name."</td>";
                    echo "<td>".$sport_name."</td>";
                    echo "<td>".$city."</td>";
                    echo "<td>".$date."</td>";
                    echo "</tr>";
                echo "</table>";
            ?>
        <div class="input-group mb-4">
            <span class="input-group-text">Feedback</span>
            <textarea class="form-control" name="feedback" aria-label="Feedback" rows="5"></textarea>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Add feedback</button>
            <a href="./info.php?user_id=<?php echo $id?>" class="btn btn-danger float-end">Cancel</a>
        </div>
    </form>
    
    </div>
</body>
</html>