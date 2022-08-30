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

    <?php
        $conn = new mysqli("localhost","root","","fia3_website");
        $id = $_GET['user_id'];

    if(isset($_POST["find_create"])){
            $find_create = $_POST["find_create"];
            $sport_id = $_POST["sport_id"];
            if ($find_create == "find"){
                header("Location: Find_game.php?user_id=$id&sport_id=$sport_id");
            };
            if($find_create == "create"){
                header("Location: Create_game.php?user_id=$id&sport_id=$sport_id");
            };
        };
    ?>
</head>
<body>

        <!-- nav -->
    <div class="m-10" id="nev" style="margin-bottom: 8%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h3>Find Or Create Your Game</h3>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="info.php?user_id=<?php echo $id?>" class="nav-item nav-link btn btn-danger text-white">back to mentor info page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>


        <div class="card position-absolute top-50 start-50 translate-middle text-center col-4">
            <div class="card-header">
                <h1>Find Or Create Your Game</h1>
            </div>
            <div class="card-body">
    <form name="submitForm" action="Find_or_create.php?user_id=<?php echo $id?>" method="POST">
        <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Sport Options</label>
        <select name="sport_id">
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
        </div>
        <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Find Game or Create One</label>
        <select name="find_create" id="">
            <option value="find">Find a game</option>
            <option value="create">Create a match</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <input type="submit" name="submit" value="submit" />
    </div>
    </form>
    </div>
        <div class="card-footer text-muted">
            <a href="info.php?user_id=<?php echo $id?>" class="btn btn-danger">cancel</a>
        </div>
        </div>
</body>
</html>