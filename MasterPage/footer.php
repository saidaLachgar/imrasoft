      </div>
    </div>
  </div>
 
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/table.js"></script>  
<script>  
  function clock() {// We create a new Date object and assign it to a variable called "time".
var time = new Date(),
    
    // Access the "getHours" method on the Date object with the dot accessor.
    hours = time.getHours(),
    
    // Access the "getMinutes" method with the dot accessor.
    minutes = time.getMinutes(),
    
    
    seconds = time.getSeconds();

document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes);
  
  function harold(standIn) {
    if (standIn < 10) {
      standIn = '0' + standIn
    }
    return standIn;
  }
}
setInterval(clock, 1000);
</script>

<script>
if (!Element.prototype.requestFullscreen) {
    Element.prototype.requestFullscreen = Element.prototype.mozRequestFullscreen || Element.prototype.webkitRequestFullscreen || Element.prototype.msRequestFullscreen;
}
if (!document.exitFullscreen) {
    document.exitFullscreen = document.mozExitFullscreen || document.webkitExitFullscreen || document.msExitFullscreen;
}
if (!document.fullscreenElement) {

    Object.defineProperty(document, 'fullscreenElement', {
        get: function() {
            return document.mozFullScreenElement || document.msFullscreenElement || document.webkitFullscreenElement;
        }
    });

    Object.defineProperty(document, 'fullscreenEnabled', {
        get: function() {
            return document.mozFullScreenEnabled || document.msFullscreenEnabled || document.webkitFullscreenEnabled;
        }
    });
}
document.addEventListener('click', function (event) {

    // Ignore clicks that weren't on the toggle button
    if (!event.target.hasAttribute('data-toggle-fullscreen')) return;

    // If there's an element in fullscreen, exit
    // Otherwise, enter it
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        document.documentElement.requestFullscreen();
    }

}, false);
</script>
<script>
function testt() {
  var x = document.getElementById("sidenav-main");
  var y = document.getElementById("content1");
  if (x.style.display === "none") { 
    y.style.marginLeft ="250px";
    x.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.marginLeft ="0px";
  }
} 
</script>
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
</body>
</html>