/******/ (() => { // webpackBootstrap
/*!**********************************!*\
  !*** ./src/block-slider/view.js ***!
  \**********************************/
document.addEventListener('DOMContentLoaded', function () {
  var swiperMedia = new Swiper('.slider-media', {
    loop: true,
    autoplay: {
      delay: 2000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    speed: 1000,
    grabCursor: true,
    mousewheelControl: true,
    keyboardControl: true,
    centeredSlides: true,
    effect: 'zoom',
    zoom: {
      maxRatio: 1.8,
      minRatio: 1
    }
  });
});
/******/ })()
;
//# sourceMappingURL=view.js.map