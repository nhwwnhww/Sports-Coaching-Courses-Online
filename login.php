<?php
  $conn = new mysqli("localhost","root","","fia3_website");
  $display_error = "none";
  if (isset($_POST["username"])){
    if (isset($_POST["password"])){
      $name = $_POST["username"];
      $pass = $_POST["password"];

      $sql = "SELECT `username`, `password` FROM `user` WHERE `username` = '$name' AND `password` = '$pass'";

      $result = $conn->query($sql);

      $sql1 = "SELECT * FROM `user` WHERE `username` = '$name' AND `password` = '$pass'";

      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
          $id = $row["user_id"];
        }
      }

      if ($result->num_rows > 0) {
          header("Location: info.php?user_id=$id");
      }
      else{
        $display_error = "block";
      };
      
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/login.css">

  <title>Login_page</title>
  <style>
      .button{
      height: 48px;
      width: 92%;
      text-align: center;
      color: #fff;
      padding: 8px;
      font: 900 20px '';
      text-transform: uppercase;
      text-decoration: none;
      font-family: sans-serif;
      box-sizing: border-box;
      background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
      background-size: 400%;
      border-radius: 30px;
      z-index: 1;
    }

    .button:before{
      content: '';
      position: absolute;
      top: -5px;
      left: -5px;
      right: -5px;
      bottom: -5px;
      z-index: -1;
      background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
      background-size: 400%;
      border-radius: 40px;
      opacity: 0;
      transition: 0.5s;
    }
    .button:hover:before{
      filter: blur(20px);
      opacity: 1;
      animation: animate 8s linear infinite;
    }
    .error{
    display: flex;
    margin-top: 3%;
    align-items: center;
    flex-direction: column;
    }
    #error_box{
      width: 80%;
      background-color: red;
      border-radius: 10px;
      color:white;
    }
    </style>
</head>
<body>
  <div class="main">
      <div class="body">
            <div class="text">
            <p class="head">Sign in</p>
                <form name="submitForm" action="login.php" method="POST" onsubmit="return validateForm()">
                  <input type="text" class="input" placeholder="username" name="username">
                  <input type="password" class="input" placeholder="password" name="password">
                  <button class="button" type="submit">Login</button>
                </form>
                <div class="error">
                  <div id="error_box">
                    <p style="display: <?php echo $display_error ?>;">Error: Sorry, there is no match for that username and/or password.</p>
                  </div>
                </div>
            <div class="sign" style="color: black">Don't have account? <br><a href="register.php">Sign up here</a><br><a href="index.php">Back to home</a></div>
            </div>
          </div>
      <span></span>
  </div>
  <script>
  function validateForm() {
    let x = document.forms["submitForm"]["username"].value;
    let z = document.forms["submitForm"]["password"].value;
    if (x == "") {
      alert("Username must be filled out");
      return false;
    }
    if (z == "") {
      alert("password must be filled out");
      return false;
    }
  }
</script>
</body>

</html>
