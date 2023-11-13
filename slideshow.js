let slideIndex = 0;
let timeoutId;

showSlideIndex(0);

function changeSlideIndexBy(_i)
{
  slideIndex += _i
  clearTimeout(timeoutId);
  showSlideIndex(slideIndex);
}

function changeSlideIndexTo(_i)
{
  slideIndex = _i
  clearTimeout(timeoutId);
  showSlideIndex(slideIndex);
}

function showSlideIndex(_i)
{
  let _slides = document.getElementsByClassName("slide");
  let _dots = document.getElementsByClassName("dot");
  let _texts = document.getElementsByClassName("text"); // Alle Texte
  slideIndex = ((_i < 0) ? _slides.length - 1 : ((_i > _slides.length - 1) ? 0 : _i));
  for (let _j = 0; _j < _slides.length; _j++)
  {
    _slides[_j].style.display = "none";
  }
  for (let _j = 0; _j < _dots.length; _j++)
  {
    _dots[_j].className = _dots[_j].className.replace(" dot-active", "");
  }
  _slides[slideIndex].style.display = "block";
  _dots[slideIndex].className += " dot-active";
  _texts[slideIndex].style.display = "block"; // Zeige den zugehörigen Text für das aktuelle Slide an

  timeoutId = setTimeout(showSlideIndex, 5000, slideIndex + 1);
}