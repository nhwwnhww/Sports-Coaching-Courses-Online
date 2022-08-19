<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php $user_id = $_GET['user_id'];
        $sport_id = $_GET['sport_id'];?>
    <h1>Sorry, You already booked this session. Please choose another one</h1>
    <a href="mentor_session.php?user_id=<?php echo $user_id?>&sport_id=<?php echo $sport_id?>">back to mentor session page</a>
</body>
</html>