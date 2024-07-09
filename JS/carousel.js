let slideIndex = 0
showSlides(slideIndex)

function changeSlide(n) {
  showSlides((slideIndex += n))
}

function showSlides(n) {
  let slides = document.getElementsByClassName('carousel-slide')
  if (n >= slides.length) {
    slideIndex = 0
  }
  if (n < 0) {
    slideIndex = slides.length - 1
  }
  for (let i = 0; i < slides.length; i++) {
    slides[i].classList.remove('active')
  }
  slides[slideIndex].classList.add('active')
}

setInterval(() => {
  changeSlide(1)
}, 25000)