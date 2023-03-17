var startTime = Date.now();
var timerElement = document.getElementById("timer");
setInterval(function () {
   var elapsedTime = Date.now() - startTime;
   var hours = Math.floor(elapsedTime / 3600000);
   var minutes = Math.floor((elapsedTime % 3600000) / 60000);
   var seconds = Math.floor((elapsedTime % 60000) / 1000);
   var formattedTime = ("0" + hours).slice(-2) + ":" + ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2);
   timerElement.innerHTML = formattedTime;
}, 1000);