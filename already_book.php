<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/counter.css">

</head>
<body>
    <?php 
    $user_id = $_GET['user_id'];
    $sport_id = $_GET['sport_id'];
    ?>

    <script>
        var time = 60;
        var delayInMilliseconds = 1000;
        calcValues();
        var int = setInterval(calcValues, 1000);

        function calcValues() {
            $('.counter .to')
                .addClass('hide')
                .removeClass('to')
                .addClass('from')
                .removeClass('hide')
                .addClass('n')
                .find('span:not(.shadow)').each(function (i, el) {
                $(el).text(getSec(true,time));
            });
            $('.counter .from:not(.n)')
                .addClass('hide')
                .addClass('to')
                .removeClass('from')
                .removeClass('hide')
            .find('span:not(.shadow)').each(function (i, el) {
                $(el).text(getSec(false,time));
            });
            $('.counter .n').removeClass('n');
            time = counter(time);
        };

        function counter(time){
        time-=1;
        return time;
        }

        function getSec(next,sec) {
            if (next) {
                sec--;
                if (sec < 0) {
                    Redirect();
                }
            } else if(sec == 60) {
                sec = 0;
            }
            return (sec < 10 ? '0' + sec : sec);
        }
        function Redirect()
        {
        window.location="mentor_session.php?user_id=<?php echo $user_id?>&sport_id=<?php echo $sport_id?>";
        }
    </script>

    <h1>
    Sorry, You already booked this session
    <br>
    Please choose another one
        <br>
    Still
        <div class="counter">
        <span class="decor top"></span>
        <span class="decor bottom"></span>
        <span class="from top"><span></span><span class="shadow"></span></span>
        <span class="from bottom"><span></span><span class="shadow"></span></span>
        <span class="to top"><span></span><span class="shadow"></span></span>
        <span class="to bottom"><span></span><span class="shadow"></span></span>
        </div>
        seconds to redirect previous page
        <br>
        <a href="mentor_session.php?user_id=<?php echo $user_id?>&sport_id=<?php echo $sport_id?>" class="btn btn-primary">Back to mentor session page</a>
    </h1>
</body>
</html>