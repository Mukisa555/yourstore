'use strict';

class Carousel {
  CarouselSlickQuickView() {
    jQuery('#tbay-quick-view-content .woocommerce-product-gallery__wrapper').each(function () {
      let _this = jQuery(this);

      if (_this.children().length == 0) {
        return;
      }

      var _config = {};
      _config.slidesToShow = 1;
      _config.infinite = false;
      _config.focusOnSelect = true;
      _config.dots = false;
      _config.arrows = true;
      _config.adaptiveHeight = true;
      _config.mobileFirst = true;
      _config.vertical = false;
      _config.cssEase = 'ease';
      _config.prevArrow = '<button type="button" class="slick-prev"><i class="icon-arrow-left icons"></i></button>';
      _config.nextArrow = '<button type="button" class="slick-next"><i class="icon-arrow-right icons"></i></button>';
      _config.settings = "unslick";
      _config.rtl = _this.parent('.woocommerce-product-gallery').data('rtl') === 'yes';
      jQuery(".variations_form").on("woocommerce_variation_select_change", function () {
        _this.slick("slickGoTo", 0);
      });

      _this.slick(_config);
    });
  }

  CarouselSlick() {
    var _this = this;

    if (jQuery(".owl-carousel[data-carousel=owl]:visible").length === 0) return;
    jQuery('.owl-carousel[data-carousel=owl]:visible:not(.scroll-init)').each(function () {
      _this._initCarouselSlick(jQuery(this));
    });
    jQuery('.owl-carousel[data-carousel=owl]:visible.scroll-init').waypoint(function () {
      let _this2 = jQuery(jQuery(this)[0].element);

      _this._initCarouselSlick(_this2);
    }, {
      offset: '100%'
    });
  }

  _initCarouselSlick(_this2) {
    var _this = this;

    if (_this2.hasClass("slick-initialized")) return;

    _this2.slick(_this._getSlickConfigOption(_this2));
  }

  _getSlickConfigOption(el) {
    var slidesToShow = jQuery(el).data('items'),
        rows = jQuery(el).data('rows') ? parseInt(jQuery(el).data('rows')) : 1,
        desktop = jQuery(el).data('desktopslick') ? jQuery(el).data('desktopslick') : slidesToShow,
        desktopsmall = jQuery(el).data('desktopsmallslick') ? jQuery(el).data('desktopsmallslick') : slidesToShow,
        tablet = jQuery(el).data('tabletslick') ? jQuery(el).data('tabletslick') : slidesToShow,
        landscape = jQuery(el).data('landscapeslick') ? jQuery(el).data('landscapeslick') : 2,
        mobile = jQuery(el).data('mobileslick') ? jQuery(el).data('mobileslick') : 2;
    let pagination = slidesToShow < jQuery(el).find('.item').length ? jQuery(el).data('pagination') : false,
        nav = slidesToShow < jQuery(el).find('.item').length ? jQuery(el).data('nav') : false,
        loop = slidesToShow < jQuery(el).find('.item').length ? jQuery(el).data('loop') : false,
        auto = slidesToShow < jQuery(el).find('.item').length ? jQuery(el).data('auto') : false;
    var _config = {};
    _config.dots = pagination;
    _config.arrows = nav;
    _config.infinite = loop;
    _config.speed = 1000;
    _config.autoplay = auto;
    _config.autoplaySpeed = jQuery(el).data('autospeed') ? jQuery(el).data('autospeed') : 2000;
    _config.cssEase = 'ease';
    _config.slidesToShow = slidesToShow;
    _config.slidesToScroll = slidesToShow;
    _config.mobileFirst = true;
    _config.vertical = false;
    _config.prevArrow = '<button type="button" class="slick-prev"><i class="icon-arrow-left icons"></i></button>';
    _config.nextArrow = '<button type="button" class="slick-next"><i class="icon-arrow-right icons"></i></button>';
    _config.rtl = jQuery('html').attr('dir') == 'rtl';

    if (rows > 1) {
      _config.slidesToShow = 1;
      _config.slidesToScroll = 1;
      _config.rows = rows;
      _config.slidesPerRow = slidesToShow;
      var settingsFull = {
        slidesPerRow: slidesToShow
      },
          settingsDesktop = {
        slidesPerRow: desktop
      },
          settingsDesktopsmall = {
        slidesPerRow: desktopsmall
      },
          settingsTablet = {
        slidesPerRow: tablet
      },
          settingsLandscape = jQuery(el).data('unslick') ? "unslick" : {
        slidesPerRow: landscape
      },
          settingsMobile = jQuery(el).data('unslick') ? "unslick" : {
        slidesPerRow: mobile
      };
    } else {
      var settingsFull = {
        slidesToShow: slidesToShow,
        slidesToScroll: slidesToShow
      },
          settingsDesktop = {
        slidesToShow: desktop,
        slidesToScroll: desktop
      },
          settingsDesktopsmall = {
        slidesToShow: desktopsmall,
        slidesToScroll: desktopsmall
      },
          settingsTablet = {
        slidesToShow: tablet,
        slidesToScroll: tablet
      },
          settingsLandscape = jQuery(el).data('unslick') ? "unslick" : {
        slidesToShow: landscape,
        slidesToScroll: landscape
      },
          settingsMobile = jQuery(el).data('unslick') ? "unslick" : {
        slidesToShow: mobile,
        slidesToScroll: mobile
      };
    }

    var settingsArrows = jQuery(el).data('nav') ? {
      arrows: false,
      dots: true
    } : '';
    settingsLandscape = jQuery(el).data('unslick') ? settingsLandscape : jQuery.extend(true, settingsLandscape, settingsArrows);
    settingsMobile = jQuery(el).data('unslick') ? settingsMobile : jQuery.extend(true, settingsMobile, settingsArrows);
    _config.responsive = [{
      breakpoint: 1600,
      settings: settingsFull
    }, {
      breakpoint: 1199,
      settings: settingsDesktop
    }, {
      breakpoint: 991,
      settings: settingsDesktopsmall
    }, {
      breakpoint: 767,
      settings: settingsTablet
    }, {
      breakpoint: 479,
      settings: settingsLandscape
    }, {
      breakpoint: 0,
      settings: settingsMobile
    }];
    return _config;
  }

  getSlickTabs() {
    var _this = this;

    jQuery('ul.nav-tabs li a').on('shown.bs.tab', event => {
      let carouselItemTab = jQuery(jQuery(event.target).attr("href")).find(".owl-carousel[data-carousel=owl]:visible");
      let carouselItemDestroy = jQuery(jQuery(event.relatedTarget).attr("href")).find(".owl-carousel[data-carousel=owl]");

      if (carouselItemDestroy.hasClass("slick-initialized")) {
        carouselItemDestroy.slick('unslick');
      }

      if (!carouselItemTab.hasClass("slick-initialized")) {
        carouselItemTab.slick(_this._getSlickConfigOption(carouselItemTab));
      }
    });
  }

}

class Slider {
  tbaySlickSlider() {
    jQuery('.single-product').find('.flex-control-thumbs').each(function () {
      if (jQuery(this).children().length == 0) {
        return;
      }

      var _config = {};
      _config.vertical = jQuery(this).parent('.woocommerce-product-gallery').data('layout') === 'vertical';
      _config.slidesToShow = jQuery(this).parent('.woocommerce-product-gallery').data('columns');
      _config.infinite = false;
      _config.focusOnSelect = true;
      _config.settings = "unslick";
      _config.prevArrow = '<span class="owl-prev"></span>';
      _config.nextArrow = '<span class="owl-next"></span>';
      _config.rtl = jQuery('body').hasClass('rtl') && jQuery(this).parent('.woocommerce-product-gallery').data('layout') !== 'vertical';
      _config.responsive = [{
        breakpoint: 1200,
        settings: {
          vertical: false,
          slidesToShow: 4
        }
      }];
      jQuery(this).slick(_config);
    });
  }

}

class Layout {
  tbaySlickLayoutSlide() {
    if (jQuery('.tbay-slider-for').length > 0) {
      var _configfor = {};
      var _confignav = {};
      _configfor.rtl = _confignav.rtl = jQuery('body').hasClass('rtl');
      _configfor.slidesToShow = 1;
      var number_table = 1;

      if (jQuery('.tbay-slider-for').data('number') > 0) {
        _configfor.slidesToShow = jQuery('.tbay-slider-for').data('number');
        number_table = jQuery('.tbay-slider-for').data('number') - 1;
      }

      _configfor.arrows = true;
      _configfor.infinite = true;
      _configfor.slidesToScroll = 1;
      _configfor.prevArrow = '<span class="slick-prev"><i class="icon-arrow-left icons"></i></span>';
      _configfor.nextArrow = '<span class="slick-next"><i class="icon-arrow-right icons"></i></span>';
      _configfor.responsive = [{
        breakpoint: 1025,
        settings: {
          vertical: false,
          slidesToShow: number_table
        }
      }, {
        breakpoint: 480,
        settings: {
          vertical: false,
          slidesToShow: 1
        }
      }];
      jQuery('.tbay-slider-for').slick(_configfor);

      if (jQuery('.single-product .tbay-slider-for .slick-slide').length) {
        jQuery('.single-product .tbay-slider-for .slick-track').addClass('woocommerce-product-gallery__image single-product-main-image');
      }
    }
  }

}

class Slider_gallery {
  tbay_slider_gallery() {
    var _config = {};
    _config.slidesToShow = 1;
    _config.slidesToScroll = 1;
    _config.prevArrow = '<button type="button" class="slick-prev"><i class="linear-icon-chevron-left"></i></button>';
    _config.nextArrow = '<button type="button" class="slick-next"><i class="linear-icon-chevron-right"></i></button>';
    this.tbay_slider_gallery_hover(_config);
    jQuery(document.body).on('urna_lazyload_image', () => {
      this.tbay_slider_gallery_hover(_config);
    });
    jQuery(document.body).on('urna_gallery_resize', () => {
      jQuery('.tbay-product-slider-gallery').each(function (index, value) {
        if (jQuery(this).hasClass("slick-initialized")) {
          jQuery(this).slick('unslick');
          jQuery(this).removeAttr('style');
        }
      });
    });
  }

  tbay_slider_gallery_hover(_config) {
    jQuery('.has-slider-gallery').find('.product-image').hover(function (e) {
      let _this = jQuery(e.currentTarget);

      if (!_this.next('.tbay-product-slider-gallery').hasClass("slick-initialized")) {
        _this.next('.tbay-product-slider-gallery').css('height', _this.parent().outerHeight());

        _this.next('.tbay-product-slider-gallery').slick(_config);
      }
    });
  }

}

(function ($, sr) {
  var debounce = function (func, threshold, execAsap) {
    var timeout;
    return function debounced() {
      var obj = this,
          args = arguments;

      function delayed() {
        if (!execAsap) func.apply(obj, args);
        timeout = null;
      }
      if (timeout) clearTimeout(timeout);else if (execAsap) func.apply(obj, args);
      timeout = setTimeout(delayed, threshold || 100);
    };
  };

  jQuery.fn[sr] = function (fn) {
    return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
  };
})(jQuery, 'smartresizefunc');

jQuery(document).ready(function () {
  var carousel = new Carousel();
  var layout = new Layout();
  carousel.CarouselSlick();
  carousel.getSlickTabs();

  if (typeof urna_settings.single_product !== "undefined" && urna_settings.single_product) {
    if (urna_settings.single_layout === 'full-width-carousel') {
      layout.tbaySlickLayoutSlide();
    }
  }

  if (urna_settings.images_mode === 'slider') {
    var slider_gallery = new Slider_gallery();
    slider_gallery.tbay_slider_gallery();
  }

  jQuery(window).smartresizefunc(function () {
    if (jQuery(window).width() >= 767) {
      try {
        if (urna_settings.images_mode === 'slider') {
          slider_gallery.tbay_slider_gallery();
        }
      } catch (err) {}
    }
  });
});
jQuery(document.body).on('wc-product-gallery-after-init', () => {
  var carousel = new Carousel();
  var slider = new Slider();

  if (typeof urna_settings.single_product !== "undefined" && urna_settings.single_product) {
    if (urna_settings.single_layout !== 'full-width-carousel') {
      slider.tbaySlickSlider();
    }
  }

  jQuery(window).smartresizefunc(function () {
    if (jQuery(window).width() >= 767) {
      try {
        carousel.CarouselSlick();

        if (typeof urna_settings.single_product !== "undefined" && urna_settings.single_product) {
          if (urna_settings.single_layout !== 'full-width-carousel') {
            slider.tbaySlickSlider();
          }
        }
      } catch (err) {}
    }
  });
});
setTimeout(function () {
  jQuery(document.body).on('urna_quick_view', () => {
    var carousel = new Carousel();
    carousel.CarouselSlickQuickView();
  });
  jQuery(document.body).on('tbay_carousel_slick', () => {
    var carousel = new Carousel();
    carousel.CarouselSlick();
  });
}, 2000);

var CustomSlickHandler = function ($scope, $) {
  var carousel = new Carousel();
  carousel.CarouselSlick();
};

jQuery(window).on('elementor/frontend/init', function () {
  if (typeof urna_settings !== "undefined" && Array.isArray(urna_settings.elements_ready.slick)) {
    jQuery.each(urna_settings.elements_ready.slick, function (index, value) {
      elementorFrontend.hooks.addAction('frontend/element_ready/tbay-' + value + '.default', CustomSlickHandler);
    });
  }
});
