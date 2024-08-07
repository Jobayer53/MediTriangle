// (function($) {
//     var CLASS_CONTAINER = "del-slider";
//     var CLASS_PREV = "del-slider-prev";
//     var CLASS_NEXT = "del-slider-next";
//     var CLASS_DOTS = "del-slider-dots";
//     var CLASS_DOT = "del-slider-dot";
//     var CLASS_ACTIVE = "del-slider-dot-active";
//     var FADE_DELAY = 800;

//     $.widget("deloma.delSlider", {
//         options: {
//             initHeight: false,
//         },

//         /*
//          * init DOM and resize handler
//          */
//         _create: function() {
//             var widget = this;
//             var container = $(this.element);

//             // add container class in case it was missing
//             container.addClass(CLASS_CONTAINER);

//             var slides = container.children('div');
//             if (slides.length > 0) {
//                 // add after last div so optional placeholder img is not last item
//                 var slideLast = $(slides[slides.length - 1]);

//                 // prev anchor
//                 var prev = $("<span/>").addClass(CLASS_PREV).html("❮")
//                     .click(function(){ widget.slideOffset(-1); });
//                 slideLast.after(prev);

//                 // next anchor
//                 var next = $("<span/>").addClass(CLASS_NEXT).html("❯")
//                     .click(function(){ widget.slideOffset(1); });
//                 prev.after(next);

//                 // buttons container
//                 var dots = $("<span/>").addClass(CLASS_DOTS);
//                 next.after(dots);

//                 // buttons for each slide
//                 for (var i = 0; i < slides.length; i++) {
//                     var dot = $("<span/>").addClass(CLASS_DOT)
//                         .on("click", function() {
//                             widget.slideTo($(this).index());
//                         });

//                     if (i == 0)
//                         dot.addClass(CLASS_ACTIVE);

//                     dots.append(dot);
//                 }
//             }

//             // 2. init height optional
//             if (this.option.initHeight) {
//                 this._resize();
//                 // resize handler
//                 $(window).on("resize", $.proxy(this._resize, this));
//             }
//         },

//         _destroy: function() {
//             // remove buttons
//             var container = $(this.element);
//             container.children("." + CLASS_PREV).remove();
//             container.children("." + CLASS_NEXT).remove();
//             container.children("." + CLASS_DOTS).remove();

//             // remove resize handler
//             if (this.option.initHeight)
//                 $(window).off("resize", $.proxy(this._resize, this));
//         },

//         /*
//          * Adjusts the height of the container to the height of the active slide
//          */
//         _resize: function() {
//             var container = $(this.element);
//             var index = this.getSlideIndex();
//             var slide = $(container.children('div')[index]);
//             container.css("height", slide.height());
//         },

//         /*
//          * get index of currently visible slide
//          */
//         getSlideIndex: function() {
//             // get active index
//             var index = 0;
//             var container = $(this.element);
//             var dots = container.children("." + CLASS_DOTS).children();

//             for (var i = 0; i < dots.length; i++) {
//                 if ($(dots[i]).hasClass(CLASS_ACTIVE)) {
//                     index = i;
//                     break;
//                 }
//             }
//             return index;
//         },

//         /*
//          * Selects next slide based on given offset
//          *
//          * @param indexOffset offset to select next slide. Positive offset to move forward and negative to move backwards.
//          */
//         slideOffset: function(indexOffset) {
//             // get active index
//             var indexOld = this.getSlideIndex();

//             // modulo to start at beginning again
//             var container = $(this.element);
//             var dots = container.children("." + CLASS_DOTS).children();

//             var indexNew = ((indexOld + indexOffset) + dots.length) % dots.length;

//             // select slide
//             this.slideTo(indexNew);
//         },

//         /*
//          * Shows the slide with the given index
//          *
//          * @param indexNew 0 based index of slide to display
//          */
//         slideTo: function(indexNew) {
//             var indexOld = this.getSlideIndex();
//             var container = $(this.element);
//             var dots = container.children("." + CLASS_DOTS).children();

//             if (indexOld == indexNew) return;

//             dots.removeClass(CLASS_ACTIVE);
//             $(dots[indexNew]).addClass(CLASS_ACTIVE);

//             var slides = container.children('div');

//             for (var i = 0; i < slides.length; i++) {
//                 var slide = $(slides[i]);
//                 slide.css("display", i == indexOld || i == indexNew ? "block" : "none");

//                 if (i == indexOld) {
//                     slide.stop().fadeTo(FADE_DELAY, 0, function() {
//                         $(this).css("display", "none");
//                     });
//                 } else if (i == indexNew) {
//                     slide.stop().css("opacity", 0).css("display", "block").fadeTo(FADE_DELAY, 1);
//                 }
//             }
//         }
//     });
// })(jQuery);

// $(document).ready(function() {
//     $(".del-slider").delSlider();
// });
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
