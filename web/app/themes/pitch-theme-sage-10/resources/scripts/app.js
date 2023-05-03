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

  loadMoreCgp();
  checkCookie();
  getCaseStudiesOnFilterChange();
  getPostsOnFilterChange();
  resetFiltersStudyCase();
  resetFiltersBlog();
  dropdown();
  slideshowRelatedNews();
  slideshowNews();
  slideshowProducts();
  slideshowText();
  slideshowNeeds();
  slideshowAwards();
  slideshowCaseStudies();
  getMobileSubmenu();
  getStickyMenu();
  getGeoLocation();
  gMapAutocomplete();

  function loadMoreCgp() {
    jQuery("#loadMore").on('click', function () {
      //init
      var that = jQuery(this);
      var page = that.data('page');
      var newPage = page + 1;
      var ajaxurl = that.data('url');
      var lat = that.data('lat');
      var lng = that.data('lng');
      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          page: page,
          lat: lat != 0 ? lat : '',
          lng: lng != 0 ? lng : '',
          action: 'ajax_script_load_more_cgp',
        },
        error: function (response) {
          console.log(response);
        },
        success: function (response) {
          //check
          if (response == 0) {
            jQuery('#cgp-results').append('<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>');
          } else {
            console.log(newPage);
            that.data('page', newPage);
            jQuery('#cgp-results').append(response);
          }
        },
      });
    });
  }

  document.querySelector('input#toggle-a').addEventListener('click', function() {
    setTimeout(function() {
      window.location.href = 'https://www.nortia.fr/?site=1';
    }, 400);
  });

  // Fonction pour récupérer la valeur d'un paramètre dans l'URL
  function getUrlParameter(name) {
    var regex = new RegExp('[\\?&]' + name.replace(/[[\]]/g, '\\$&') + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  }


  function checkCookie() {
    // Récupérer la valeur du paramètre "site" dans l'URL
    var siteParam = getUrlParameter('site');

    if (siteParam === '1') {
      // Code pour définir le cookie ici, par exemple :
      setCookie('site_selector', 1);
    } else {

      const selection = getCookie('site_selector');
      const myModal = new bootstrap.Modal(document.querySelector('#site-selector'), {
        keyboard: false,
      });

      if (!selection) {
        myModal.show();
      }
    }
  }

  function getCookie(cname) {
    const name = `${cname}=`;
    const cookies = document.cookie.split(';');

    for (const cookie of cookies) {
      const trimmedCookie = cookie.trim();
      if (trimmedCookie.startsWith(name)) {
        return trimmedCookie.substring(name.length);
      }
    }

    return "";
  }

  function dropdown() {
    const navLinks = document.querySelectorAll('.nav-link.dropdown-toggle');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    navLinks.forEach(navLink => {
      navLink.addEventListener('mouseenter', () => {
        navLink.classList.add('show');
      });

      navLink.addEventListener('mouseleave', () => {
        navLink.classList.remove('show');
      });
    });

    dropdownMenus.forEach(dropdownMenu => {
      dropdownMenu.addEventListener('mouseenter', () => {
        Array.from(dropdownMenu.parentElement.children).forEach(child => {
          child.classList.add('show');
        });
      });

      dropdownMenu.addEventListener('mouseleave', () => {
        Array.from(dropdownMenu.parentElement.children).forEach(child => {
          child.classList.remove('show');
        });
      });
    });
  }

  function getCaseStudiesOnFilterChange() {
    const form = document.querySelector('form#study-case-filter');
    if (form) {
      form.addEventListener('change', () => {
        const category = form.querySelector('select#category').value;
        const month = form.querySelector('select#month').value;
        const year = form.querySelector('select#year').value;
        const ajaxFunction = 'ajax_case_studies_load';
        const ajaxFunctionTitle = 'ajax_case_studies_title_load';
        const pageurl = 'https://www.nortia.fr/nos-analyses-dexperts/';

        setCookie('study-case-category', category);
        setCookie('study-case-month', month);
        setCookie('study-case-year', year);

        const resetButton = document.querySelector('#reset');
        resetButton.classList.remove('d-none');
        resetButton.classList.add('d-block');

        setPageNumber();

        ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
        ajaxChangeTitle(category, ajaxFunctionTitle);
      });
    }
  }

  function resetFiltersStudyCase() {
    const form = document.querySelector('form#study-case-filter');
    const resetButton = form ? form.querySelector('#reset a') : null;

    if (resetButton) {
      resetButton.addEventListener('click', () => {
        const category = 'all';
        const month = 'all';
        const year = 'all';
        const ajaxFunction = 'ajax_case_studies_load';
        const ajaxFunctionTitle = 'ajax_case_studies_title_load';
        const pageurl = 'https://www.nortia.fr/nos-analyses-dexperts/';

        setCookie('study-case-category', category);
        setCookie('study-case-month', month);
        setCookie('study-case-year', year);

        const resetDiv = document.querySelector('#reset');
        resetDiv.classList.remove('d-block');
        resetDiv.classList.add('d-none');

        setPageNumber();

        ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
        ajaxChangeTitle(category, ajaxFunctionTitle);
      });
    }
  }

  function resetFiltersBlog() {
    const form = document.querySelector('form#blog-filter');
    const resetButton = form ? form.querySelector('#reset a') : null;

    if (resetButton) {
      resetButton.addEventListener('click', () => {
        const category = 'all';
        const month = 'all';
        const year = 'all';
        const ajaxFunction = 'ajax_posts_load';
        const ajaxFunctionTitle = 'ajax_posts_title_load';
        const pageurl = 'https://www.nortia.fr/actualite-nortia/';

        setCookie('category', category);
        setCookie('month', month);
        setCookie('year', year);

        const resetDiv = document.querySelector('#reset');
        resetDiv.classList.remove('d-block');
        resetDiv.classList.add('d-none');

        setPageNumber();

        ajaxChangeTitle(category, ajaxFunctionTitle);
        ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
      });
    }
  }

  function getPostsOnFilterChange() {
    const blogFilterForm = document.querySelector('form#blog-filter');
    if (blogFilterForm) {
      blogFilterForm.addEventListener('change', () => {
        const category = blogFilterForm.querySelector('select#category').value;
        const month = blogFilterForm.querySelector('select#month').value;
        const year = blogFilterForm.querySelector('select#year').value;
        const ajaxFunction = 'ajax_posts_load';
        const ajaxFunctionTitle = 'ajax_posts_title_load';
        const pageurl = 'https://www.nortia.fr/actualite-nortia/';

        setCookie('category', category);
        setCookie('month', month);
        setCookie('year', year);

        const resetButton = document.querySelector('#reset');
        resetButton.classList.remove('d-none');
        resetButton.classList.add('d-block');

        setPageNumber();

        ajaxGetPosts(category, month, year, ajaxFunction, pageurl);
        ajaxChangeTitle(category, ajaxFunctionTitle);
      });
    }
  }

  function setCookie(name, value) {
    const date = new Date();
    date.setTime(date.getTime() + (60 * 60 * 1000));
    const expires = '; expires=' + date.toGMTString();

    if (value.length === 0) {
      document.cookie = `${name}=${JSON.stringify(value)};expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/`;
    } else {
      document.cookie = `${name}=${JSON.stringify(value)}${expires}; path=/`;
    }
  }

  function setPageNumber() {
    const paginationInput = document.querySelector('input#pagination');

    if (paginationInput) {
      const pagination = paginationInput.value;
      if (pagination > 1) {
        window.location.replace('/blog/');
      }
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
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

    jQuery('.slick-arrow-prev', section).on('click', function () {
      slideshow.slick('slickPrev');
    });

    jQuery('.slick-arrow-next', section).on('click', function () {
      slideshow.slick('slickNext');
    });
  }

  function getMobileSubmenu() {
    jQuery(".navbar-mobile li.menu-item-has-children").on("click", function (event) {
      event.preventDefault();
    });

    jQuery('.navbar-mobile li.menu-item-has-children a').on(
      'click',
      function (event) {
        event.preventDefault();
        var that = jQuery(this);
        var parent = that.text();
        var data = parent.trim();
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
      },
    );
  }

  function resetMobileMenu() {
    jQuery('#menu-mobile-data a.reset').on('click', function (event) {
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
    jQuery('.navbar-mobile li.menu-item-type-taxonomy a').removeAttr(
      'href',
    );
  }

  function getStickyMenu() {
    const el_html = document.documentElement;
    const el_body = document.querySelector('body');
    const regexp = /(nav-is-stuck)/i;

    const menuIsStuck = () => {
      const wScrollTop = window.pageYOffset || el_body.scrollTop;
      const classFound = el_html.className.match(regexp);
      const scrollValue = 0;

      if (wScrollTop > scrollValue && !classFound) {
        el_html.classList.add('nav-is-stuck');
        el_body.style.paddingTop = '0';
      } else if (wScrollTop < 2 && classFound) {
        el_html.classList.remove('nav-is-stuck');
        el_body.style.paddingTop = '0';
      }
    };

    const onScrolling = () => {
      menuIsStuck();
    };

    window.addEventListener('scroll', () => {
      window.requestAnimationFrame(onScrolling);
    });
  }

  function getGeoLocation() {
    let geoLocationBtn = document.querySelector('button#geolocation');
    let latField = document.querySelector('input#lat');
    let lngField = document.querySelector('input#lng');
    let geoForm = document.querySelector('form#cgp-locator');
    if (geoLocationBtn) {
      geoLocationBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if ('geolocation' in navigator) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          console.log(
            'Geolocation is not supported by this browser.',
          );
        }
      });
    }
    const showPosition = (position) => {
      latField.value = position.coords.latitude;
      lngField.value = position.coords.longitude;
      geoForm.submit();
    };
  }

  function gMapAutocomplete() {
    let locationField = document.querySelector('input#locationField');
    if (locationField) {
      // eslint-disable-next-line no-undef
      let autocomplete = new google.maps.places.Autocomplete(
        locationField,
        {
          types: ['geocode'],
          componentRestrictions: {country: ['fr', 'nc', 'mq', 'pf']},
        },
      );
      autocomplete.setFields(['address_component', 'geometry']);
      autocomplete.addListener('place_changed', function () {
        let place = autocomplete.getPlace();
        // Fill out form fields
        let latField = document.querySelector('input#lat');
        let lngField = document.querySelector('input#lng');
        latField.value = place.geometry.location.lat();
        lngField.value = place.geometry.location.lng();
      });
    }
  }
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
