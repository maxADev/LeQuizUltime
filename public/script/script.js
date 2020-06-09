var count = 1;
var countDisplay = 2;
var a = 1;
var returnCount;
var returnCountDisplay;

document.getElementById("nextQuestion").addEventListener("click", function() {
  count ++;
  countDisplay = count-1;

  var element = document.getElementById('Question'+count);
  element.style.display = 'block';

  document.getElementById("nextQuestion").innerHTML = 'Question suivante';
  document.getElementById("numeroQuesiton").innerHTML = 'Question'+count;

  var elementDisplay = document.getElementById('Question'+countDisplay);
  elementDisplay.style.display = 'none';

if(count >= 20) {
    var element = document.getElementById('nextQuestion');
    element.style.display = 'none';

    var elementEnvoyez = document.getElementById('envoyez');
    elementEnvoyez.style.display = 'block';

}   else {
        var element = document.getElementById('nextQuestion');
        element.style.display = 'block';

        var elementEnvoyez = document.getElementById('envoyez');
        elementEnvoyez.style.display = 'none';
}

if(count <= 1) {
    var element = document.getElementById('returnQuestion');
    element.style.display = 'none';
}   else {
        var element = document.getElementById('returnQuestion');
        element.style.display = 'block';
}
});

document.getElementById("returnQuestion").addEventListener("click", function() {
    returnCount = count - a;
    returnCountDisplay = countDisplay + a;

    var elementDisplay = document.getElementById('Question'+returnCountDisplay);
    elementDisplay.style.display = 'none';

    var element = document.getElementById('Question'+returnCount);
    element.style.display = 'block';
    
    count = returnCount;
    countDisplay = returnCountDisplay - 2;
    document.getElementById("numeroQuesiton").innerHTML = 'Question'+count;

if(count >= 20) {
    var element = document.getElementById('nextQuestion');
    element.style.display = 'none';

    var elementEnvoyez = document.getElementById('envoyez');
    elementEnvoyez.style.display = 'block';

}   else {
        var element = document.getElementById('nextQuestion');
        element.style.display = 'block';

        var elementEnvoyez = document.getElementById('envoyez');
        elementEnvoyez.style.display = 'none';
}

if(count <= 1) {
    var element = document.getElementById('returnQuestion');
    element.style.display = 'none';
    
}   else {
        var element = document.getElementById('returnQuestion');
        element.style.display = 'block';
}

}); 

