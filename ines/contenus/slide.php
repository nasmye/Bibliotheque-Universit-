


<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext"></div>
  <img src="images/image-1.jpg" style="width:100%">
  <div class="text">“La lecture, une porte ouverte sur un monde enchanté.”<br> <small >François Mauriac </small></div>
</div>

<div class="mySlides fade">
  <div class="numbertext"></div>
  <img src="images/image-2.jpg" style="width:100%">
  <div class="text">“Une bibliothèque est un hôpital pour l'esprit.”<br> <small >Henry Jackson</small></div>
</div>

<div class="mySlides fade">
  <div class="numbertext"></div>
  <img src="images/image-3.jpg" style="width:100%">
  <div class="text"> <b>Université Abdelhamid Ibn Badis <br><small>Bibliothèque Ines</small></b></div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 2 seconds
}
</script>




