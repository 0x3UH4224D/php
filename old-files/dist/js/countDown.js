function countDown(id, redirectTo) {
  var element = document.getElementById(id);
  var CountFrom = element.getAttribute("countFrom");
  var countDownStart = setInterval(function() {
    element.innerHTML = --CountFrom;
    if(CountFrom == 0) {
      clearInterval(countDownStart);
      window.location.href = redirectTo;
    }
  }, 1000);
}