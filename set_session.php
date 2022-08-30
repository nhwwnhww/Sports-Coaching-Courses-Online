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

        $search_mentor = "SELECT `city` FROM `user` WHERE `user_id` = $id";
        $search_mentor_result = $conn->query($search_mentor);
        if ($search_mentor_result->num_rows > 0) {
            while ($row = $search_mentor_result->fetch_assoc()) {
                $city = $row["city"];
            }
        }

    ?>
    <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h3>Setting your session</h3>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="mentor_info.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-danger text-white">back to mentor info page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="card position-absolute top-50 start-50 translate-middle text-center col-4">
            <div class="card-header">
                <h1>set your session</h1>
            </div>
            <div class="card-body">
                <form name="submitForm" action="insert_session.php?user_id=<?php echo $id?>&city=<?php echo $city?>" method="POST" enctype="multipart/form-data" class="g-3 needs-validation">   
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Sport Options</label>
                <select name="sport" id="sport">
                <?php
                    $search_sport = "SELECT  `sport_id`,`sport_name` FROM `sport`";
                    $search_sport_result = $conn->query($search_sport);
                    if ($search_sport_result->num_rows > 0) {
                        while ($row = $search_sport_result->fetch_assoc()) {
                            $sport_name = $row["sport_name"];
                            $sport_id = $row["sport_id"];
                            echo "<option value='$sport_id'>$sport_name</option>";
                        }
                    }
                ?>
                </select>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Sport date</label>
                <input type="datetime-local" name="date" required>
                <div class="invalid-feedback">
                    Please set session date
                </div>
                </div>

                <div class="input-group mb-3">
                    <input type="submit" name="submit" value="Set a session"/>
                </div>

                    <!-- I can add a set session success page after that but If I Remember :< -->
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="mentor_info.php?user_id=<?php echo $id?>" class="btn btn-danger">cancel</a>
        </div>
    </div>
</body>
</html>