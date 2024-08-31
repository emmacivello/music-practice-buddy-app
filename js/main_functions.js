function testRegInput(){ //For registration: checks if username and password > 4 chars, activates button if yes, deactivates if no
  var lenUname = document.getElementById("registerUname").value.length;
  var lenPsw = document.getElementById("registerPsw").value.length;
  if(lenUname > 4 && lenPsw > 4){
    document.getElementById("regButton").disabled = false;
  }
  else{
    document.getElementById("regButton").disabled = true;
  }
}

function activateAccordion(){ // funcion adapted from: https://www.w3schools.com/howto/howto_js_accordion.asp 
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }

      for(i=0; i<acc.length; i++){ //a loop I added to close a currently-open section before opening the one the user has just clicked
        if(acc[i] != this && acc[i].classList.contains("active")){
          acc[i].classList.toggle("active");
          var panel = acc[i].nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          }
        }
      }
    });
  }
}

function plusSlides(n) { // funcion from: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow 
  showSlides(slideIndex += n);
}

function currentSlide(n) { // funcion from: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow
  showSlides(slideIndex = n);
}

function showSlides(n) { // funcion from: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" activeSlideshow", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " activeSlideshow";
}

function startAutoplay(){ //advance the slideshow every 3 seconds
  setInterval(function(){
    if(autoplay){
      document.getElementById("nextButton").click();
    }
  }, 3000); 
}

function togglePlayPause(){ //for when user pauses or plays the slideshow
  if(autoplay){
    autoplay = false;
    var buttons = document.getElementsByClassName("playPauseButton");
    for(i=0; i<buttons.length; i++){
      buttons[i].classList.add("fa-play");
      buttons[i].classList.remove("fa-pause");
    }
  }
  else{
    autoplay = true;
    var buttons = document.getElementsByClassName("playPauseButton");
    for(i=0; i<buttons.length; i++){
      buttons[i].classList.add("fa-pause");
      buttons[i].classList.remove("fa-play");
    }
  }
}