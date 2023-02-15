import {domReady} from '@roots/sage/client';
import 'jquery';
import * as bootstrap from 'bootstrap';
import './slide-menu';

window.bootstrap = require('bootstrap');

/**
 * Addons
 */
import 'slick-carousel/slick/slick.min';
//import '@fortawesome/fontawesome-pro/js/fontawesome.min';
//import '@fortawesome/fontawesome-pro/js/all.min';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  checkCookie();
  getCaseStudiesOnFilterChange();
  getPostsOnFilterChange();
  resetFiltersStudyCase();
  resetFiltersBlog();
  slideshowRelatedNews();
  slideshowNews();
  slideshowProducts();
  slideshowText();
  slideshowNeeds();
  slideshowAwards();
  slideshowCaseStudies();
  getMobileSubmenu();
  getStickyMenu();

  jQuery('input#toggle-b').click(function() {
    setTimeout(function() {
      document.location.href = 'https://www.figma.com/';
    },400 );
  });

  function checkCookie() {
    let selection = getCookie('site_selector');
    const myModal = new bootstrap.Modal('#site-selector', {
      keyboard: false,
    });
    if (selection === "" || selection === null) {
      console.log(myModal);
      myModal.show();
      setCookie('site_selector', 1);
    }
  }

  function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  jQuery('.nav-link.dropdown-toggle').hover(function() {
    jQuery(this).addClass('show');
  });

  jQuery('.nav-link.dropdown-toggle').mouseleave(function() {
    jQuery(this).removeClass('show');
  });

  jQuery('.dropdown-menu').hover(function() {
    jQuery(this).parent().children().addClass('show');
  });

  jQuery('.dropdown-menu').mouseleave(function() {
    jQuery(this).parent().children().removeClass('show');
  });

  function getCaseStudiesOnFilterChange() {

    jQuery('form#study-case-filter').change(function () {

      var category = jQuery('form#study-case-filter select#category').val();
      var month = jQuery('form#study-case-filter select#month').val();
      var year = jQuery('form#study-case-filter select#year').val();
      var ajaxFunction = 'ajax_case_studies_load';
      var ajaxFunctionTitle = 'ajax_case_studies_title_load';
      var pageurl = 'https://www.nortia.fr/nos-analyses-dexperts/';


      setCookie('study-case-category', category);
      setCookie('study-case-month', month);
      setCookie('study-case-year', year);

      jQuery('#reset').removeClass('d-none').addClass('d-block');

      setPageNumber();

      ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
      ajaxChangeTitle(category, ajaxFunctionTitle);
    });
  }

  function resetFiltersStudyCase() {

    jQuery('form#study-case-filter #reset a').click(function () {

      var category = 'all';
      var month = 'all';
      var year = 'all';
      var ajaxFunction = 'ajax_case_studies_load';
      var ajaxFunctionTitle = 'ajax_case_studies_title_load';
      var pageurl = 'https://www.nortia.fr/nos-analyses-dexperts/';


      setCookie('study-case-category', category);
      setCookie('study-case-month', month);
      setCookie('study-case-year', year);

      jQuery('#reset').removeClass('d-block').addClass('d-none');

      setPageNumber();

      ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
      ajaxChangeTitle(category, ajaxFunctionTitle);
    });
  }

  function resetFiltersBlog() {

    jQuery('form#blog-filter #reset a').click(function () {

      var category = 'all';
      var month = 'all';
      var year = 'all';
      var ajaxFunction = 'ajax_posts_load';
      var ajaxFunctionTitle = 'ajax_posts_title_load';
      var pageurl = 'https://www.nortia.fr/actualite-nortia/';


      setCookie('category', category);
      setCookie('month', month);
      setCookie('year', year);

      jQuery('#reset').removeClass('d-block').addClass('d-none');

      setPageNumber();

      ajaxChangeTitle(category, ajaxFunctionTitle);
      ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
    });
  }


  function getPostsOnFilterChange() {

    jQuery('form#blog-filter').change(function () {

      var category = jQuery('form#blog-filter select#category').val();
      var month = jQuery('form#blog-filter select#month').val();
      var year = jQuery('form#blog-filter select#year').val();
      var ajaxFunction = 'ajax_posts_load';
      var ajaxFunctionTitle = 'ajax_posts_title_load';
      var pageurl = 'https://www.nortia.fr/actualite-nortia/';


      setCookie('category', category);
      setCookie('month', month);
      setCookie('year', year);

      jQuery('#reset').removeClass('d-none').addClass('d-block');

      setPageNumber();

      ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
      ajaxChangeTitle(category, ajaxFunctionTitle);
    });
  }

  function setCookie(name, value) {
    var date = new Date();
    date.setTime(date.getTime() + (60 * 60 * 1000));
    var expires = '; expires=' + date.toGMTString();

    if (value.length === 0) {
      document.cookie = name + '=' + JSON.stringify(value) + ';expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';
    } else {
      document.cookie = name + '=' + JSON.stringify(value) + expires + '; path=/';
    }
  }

  function setPageNumber() {
    var pagination = jQuery('input#pagination').val();
    if (pagination > 1) {
      window.location.replace('/blog/');
    }
  }

  function ajaxGetPosts(category, month, year, ajaxFunction, pageurl) {
    var ajaxurl = '/wp/wp-admin/admin-ajax.php';
    jQuery.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        pageurl: pageurl,
        month: month,
        year: year,
        category: category,
        action: ajaxFunction,
      },
      beforeSend: function () {
        jQuery('#ajaxLoader').fadeIn('slow');
      },
      error: function () {
      },
      success: function (response) {
        jQuery('#results').replaceWith(response);
        jQuery('#ajaxLoader').fadeOut('slow');
      },
    });
  }

  function ajaxChangeTitle(category, ajaxFunctionTitle) {
    var ajaxurl = '/wp/wp-admin/admin-ajax.php';
    jQuery.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        category: category,
        action: ajaxFunctionTitle,
      },
      beforeSend: function () {
      },
      error: function () {
      },
      success: function (response) {
        jQuery('#wrapper-blog-filter #title').replaceWith(response);
      },
    });
  }

  function slideshowRelatedNews() {
    var section = jQuery('.slideshow-related-news');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  function slideshowText() {
    var section = jQuery('.slideshow-text');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function slideshowNews() {
    var section = jQuery('.slideshow-news');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function slideshowProducts() {
    var section = jQuery('.slideshow-products');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function slideshowNeeds() {
    var section = jQuery('.slideshow-needs');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function slideshowAwards() {
    var section = jQuery('.slideshow-awards');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function slideshowCaseStudies() {
    var section = jQuery('.slideshow-case-studies');
    var slideshow = jQuery('.slideshow', section);

    slideshow.slick({
      infinite: false,
      dots: false,
      arrows: false,
      centerMode: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.slick-arrow-prev', section).click(function () {
      slideshow.slick("slickPrev");
    });

    jQuery('.slick-arrow-next', section).click(function () {
      slideshow.slick("slickNext");
    });
  }

  function getMobileSubmenu() {
    jQuery(".navbar-mobile li.menu-item-has-children a").click(function (event) {
      event.preventDefault();
      var that = jQuery(this);
      var parent = that.text();
      var data = jQuery.trim(parent);
      var ajaxurl = '/wp/wp-admin/admin-ajax.php';
      jQuery.ajax({
        url: ajaxurl,
        type: 'GET',
        data: {
          parent: data,
          action: 'ajax_submenu_mobile',
        },
        error: function () {
        },
        success: function (response) {
          jQuery('#menu-mobile-data').replaceWith(response);
        },
        complete: function () {
          resetMobileMenu();
          removeHrefMenuMobile();
        },
      });
    });
  }

  function resetMobileMenu() {
    jQuery("#menu-mobile-data a.reset").click(function (event) {
      event.preventDefault();
      var ajaxurl = '/wp/wp-admin/admin-ajax.php';
      jQuery.ajax({
        url: ajaxurl,
        type: 'GET',
        data: {
          action: 'ajax_submenu_mobile_reset',
        },
        error: function () {
        },
        success: function (response) {
          jQuery('#menu-mobile-data').replaceWith(response);
        },
        complete: function () {
          getMobileSubmenu();
          removeHrefMenuMobile();
        },
      });
    });
  }

  function removeHrefMenuMobile() {
    jQuery(".navbar-mobile li.menu-item-type-taxonomy a").removeAttr("href");
  }

  function getStickyMenu() {
    var w = window;
    var d = document;
    var el_html = d.documentElement,
      el_body = d.getElementsByTagName('body')[0],
      menuIsStuck = function () {
        var wScrollTop = w.pageYOffset || el_body.scrollTop,
          regexp = /(nav-is-stuck)/i,
          classFound = el_html.className.match(regexp),
          scrollValue = 0;
        if (wScrollTop > scrollValue && !classFound) {
          el_html.className = el_html.className + ' nav-is-stuck';
          el_body.style.paddingTop = '0';
        }
        if (wScrollTop < 2 && classFound) {
          el_html.className = el_html.className.replace(regexp, '');
          el_body.style.paddingTop = '0';
        }
        if (wScrollTop < 2 && classFound) {
          el_html.className = el_html.className.replace(regexp, '');
          el_body.style.paddingTop = '0';
        }
      },
      onScrolling = function () {
        menuIsStuck();
      };

    w.addEventListener('scroll', function () {
      w.requestAnimationFrame(onScrolling);
    });
  }
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
