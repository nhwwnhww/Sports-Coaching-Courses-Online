<?php
$conn = new mysqli("localhost","root","","game");

if (isset($_POST["username"])){
  $sql = "INSERT INTO `user_table`(`username`, `real name`, `password`) VALUES ('". $_POST["username"]. "','". $_POST["realname"] ."','".$_POST["password"]."')";
  $result = $conn->query($sql);

  $sql1 = "INSERT INTO `user_level`(`name`, `level`, `spend_money`) VALUES ('".$_POST["username"]."','1','0')";
  $result1 = $conn->query($sql1);
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

    <link rel="stylesheet" href="./css/login.css">

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
  </style>
</head>
<body>
  <div class="main">
      <div class="body">
            <div class="text">
            <p class="head">Sign in</p>
                <form name="submitForm" action="register.php" method="POST" onsubmit="return validateForm()">
                    <input type="text" class="input" placeholder="username" name="username">
                    <input type="text" class="input" placeholder="realname" name="realname">
                    <input type="password" class="input" placeholder="password" name="password">
                    <button type="submit" class="button">Create your account</button>
                </form>
                <a href="login.php">back to login page</a>
            </div>
          </div>
      <span></span>
  </div>

<script>
  function validateForm() {
  let x = document.forms["submitForm"]["username"].value;
  let y = document.forms["submitForm"]["realname"].value;
  let z = document.forms["submitForm"]["password"].value;
  if (x == "") {
    alert("Username must be filled out");
    return false;
  }
  if (y == "") {
    alert("realname must be filled out");
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