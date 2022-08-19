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

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        #background{
            position: fixed;
            width: 100%;
            z-index: -1;
            opacity: 0.6;
            align-items: center;
            display: flex;
            justify-content: center;
        }
        #head{
            
            z-index: 1;
            width: 100%;
            height: 100%;
        }
        #nev{
            z-index: 999; 
        }
    </style>

</head>
<body>

    <div id="background">
        <video id="video" width="100%" height="100%" autoplay muted loop>
            <source src="./video/2112531048.mp4" type="video/mp4" >
        </video>
    </div>

    <div class="m-4" id="nev">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="./img/muppets-muppet-show.gif" height="72" alt="LOGO"><h1>Wei's sport hub</h1>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="./product.php" class="nav-item nav-link">Programs & Challenges</a>
                        <a href="./login.php" class="nav-item nav-link" tabindex="-1">Member Login & register</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</body>
</html>