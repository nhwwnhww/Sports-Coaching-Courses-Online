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

  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300|Oswald);
body, html {
  width:100%;
  height:100%;
  margin:0;
  padding:0;
}
body {
  background: #555555;
  background-image: -webkit-radial-gradient(cover, #f1f1f1, #cbcbcb);
  background-image: -moz-radial-gradient(cover, #f1f1f1, #cbcbcb);
  background-image: -o-radial-gradient(cover, #f1f1f1, #cbcbcb);
  background-image: radial-gradient(cover, #f1f1f1, #cbcbcb);
}
h1 {
  font-family:'Roboto Condensed', cursive;
  text-align:center;
  line-height:100px;
  font-size:28px;
  font-weight:normal;
  position:absolute;
  top:50%;
  left:50%;
  margin:-50px 0 0 -300px;
  width:600px;
  color:#939393;
}
h1 .counter {
  font-size:50px;
  width:120px;
  height:50px;
  font-family:'Oswald', sans-serif;
  display:inline-block;
  padding:0 30px 0 10px;
  perspective: 200px;
  position:relative;
  top:-7px;
}
h1 .counter > span {
  display:block;
  position:absolute;
  overflow:hidden;
  padding:0 25px;
  background:-webkit-gradient(linear, 0 0, 0 100%, from(#FFF), to(#f2f2f2));
  background:-webkit-linear-gradient(#FFF 0%, #f2f2f2 100%);
  background:-moz-linear-gradient(#FFF 0%, #f2f2f2 100%);
  background:-o-linear-gradient(#FFF 0%, #f2f2f2 100%);
  background:linear-gradient(#FFF 0%, #f2f2f2 100%);
  height:45px;
  width:100px;
  text-align:center;
  backface-visibility:hidden;
  transform-style: preserve-3d; 
}
h1 .counter > span span {
  color:#99df1c;
}
h1 .counter > span.decor.top {
  box-shadow: 0 24px 43px -3px rgba(0, 0, 0, 0.45);
}
h1 .counter > span.decor.bottom {
  box-shadow: 0 2px 0px -1px #d8d8d8, 0 4px 0px -2px #c7c7c7, 0 6px 0px -3px #d8d8d8, 0 8px 0px -4px #c6c6c6, 0 10px 0px -5px #d6d6d6, 0 12px 0px -6px #c9c9c9, 0 14px 0px -7px #d8d8d8, 0 14px 23px -9px rgba(0, 0, 0, 0.8);
}
h1 .counter > span.top {
  box-shadow: inset 0 -1px 3px rgba(0, 0, 0, 0.2);
  border-radius:3px 3px 0 0;
}
h1 .counter > span.top span {
  position:relative;
  bottom:5px;
}
h1 .counter > span.bottom {
  top:46px;
  box-shadow: inset 0 -1px 3px rgba(0, 0, 0, 0.2);
  border-radius:0 0 3px 3px;
}
h1 .counter > span.bottom span {
  position:relative;
  top:-51px;
}
h1 .counter > span.from.bottom {
  z-index:1;
  transform-origin: 0% 0%;
  animation: from-flip 1s;
}
h1 .counter > span.to.top {
  z-index:1;
  transform-origin: 100% 100%;
  animation: to-flip 1s;
}
@keyframes from-flip {
  0% {
    transform: rotateX(180deg);
  }
  100% {
    transform: rotateX(0deg);
  }
}
@keyframes to-flip {
  0% {
    transform: rotateX(0deg);
  }
  100% {
    transform: rotateX(-180deg);
  }
}

@keyframes fade-out {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
.counter .shadow {
  display:block;
  width:120px; height:45px;
  left:-25px; top:-100px !important;
  overflow:hidden;
  z-index:0;
  opacity:0;
}
.counter .top .shadow {
  background: linear-gradient(rgba(0,0,0,0) 0%, rgba(0,0,0,0.3) 100%);
}
.counter .bottom .shadow {
  background: linear-gradient(rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%);
}
.counter .from.top .shadow { animation: fade-out 1s; }
.counter .to.bottom .shadow { animation: fade-in 1s; }
.hide .shadow { animation:none !important; }
@media screen and (-webkit-min-device-pixel-ratio:0) {  
  h1 .counter > span span {
    color:rgba(0, 0, 0, 0);
    background: linear-gradient(#99df1c 0%, #6dbe0a 100%);
    -webkit-background-clip: text;
    -webkit-text-stroke:0.03em #85c614;
  }
} 
  </style>
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
              sec = 59;
          }
      } else if(sec == 60) {
          sec = 0;
      }
    return (sec < 10 ? '0' + sec : sec);
}

  </script>
</head>
<body>
  <h1>
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
    <a href="" class="btn btn-primary">Back</a>
    </h1>

</body>
</html>