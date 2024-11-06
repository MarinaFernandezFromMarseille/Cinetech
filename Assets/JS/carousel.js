document.addEventListener("DOMContentLoaded", function(event) {
    let currentSlide = 0;
    let currentmovieSlide = 0;
    const leftBtn = document.querySelector('.left-btn');
    const rightBtn = document.querySelector('.right-btn');

    leftBtn.addEventListener('click', prevMovieSlide);
    rightBtn.addEventListener('click', nextMovieSlide);
    const slides = document.querySelectorAll('.carousel-item');
    const indicators = document.querySelectorAll('.indicator');
    const movies = document.querySelectorAll('.film');
    console.log('movies : ' + movies.length);
    function showSlide(index) {
        const carouselImages = document.querySelector('.carousel-images');
        currentSlide = index;
        const offset = -currentSlide * 100; // Calcule la position de la nouvelle image
        carouselImages.style.transform = `translateX(${offset}%)`; // Déplace les images

        // Met à jour les indicateurs actifs
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === currentSlide);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Initialiser le carrousel en affichant la première image
    showSlide(currentSlide);
    showMovieSlide(currentmovieSlide);
    // Défilement automatique des images toutes les 5 secondes
    setInterval(nextSlide, 5000);
    setInterval(nextMovieSlide, 5000);

    function nextMovieSlide() {
        console.log('Current movie slide : ' + currentmovieSlide);
        currentmovieSlide = (currentmovieSlide + 1) % movies.length;
        console.log('Movie slide after change : ' + currentmovieSlide);
        showMovieSlide(currentmovieSlide);
    }

    function prevMovieSlide() {
        console.log('Current movie slide : ' + currentmovieSlide);
        currentmovieSlide = (currentmovieSlide - 1 + movies.length) % movies.length;
        showMovieSlide(currentmovieSlide);
    }

    function showMovieSlide(index) {
        const movieCarousel = document.querySelector('.films');
        currentmovieSlide = index;
        const offset = -currentmovieSlide * 100; // Calcule la position de la nouvelle image
        movieCarousel.style.transform = `translateX(${offset}%)`; // Déplace les images
        console.log('Offset : ' + offset + 'Current movie slide : ' + currentmovieSlide);
    }
});