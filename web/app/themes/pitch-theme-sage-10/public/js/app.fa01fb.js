"use strict";(self.webpackChunksage=self.webpackChunksage||[]).push([[143],{537:function(e,o,t){var s=t(575),n=(t(567),t(138));t(459),t(129),window.bootstrap=t(138);const r=async e=>{var o,t,s,r,i,a;function l(e,o){var t=new Date;t.setTime(t.getTime()+36e5);var s="; expires="+t.toGMTString();0===o.length?document.cookie=e+"="+JSON.stringify(o)+";expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/":document.cookie=e+"="+JSON.stringify(o)+s+"; path=/"}function c(){jQuery("input#pagination").val()>1&&window.location.replace("/blog/")}function u(e,o,t,s,n){jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"POST",data:{pageurl:n,month:o,year:t,category:e,action:s},beforeSend:function(){jQuery("#ajaxLoader").fadeIn("slow")},error:function(){},success:function(e){jQuery("#results").replaceWith(e),jQuery("#ajaxLoader").fadeOut("slow")}})}function d(e,o){jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"POST",data:{category:e,action:o},beforeSend:function(){},error:function(){},success:function(e){jQuery("#wrapper-blog-filter #title").replaceWith(e)}})}function y(){jQuery(".navbar-mobile li.menu-item-type-taxonomy a").removeAttr("href")}e&&console.error(e),function(){let e=function(e){let o="site_selector=",t=document.cookie.split(";");for(let e=0;e<t.length;e++){let s=t[e];for(;" "==s.charAt(0);)s=s.substring(1);if(0==s.indexOf(o))return s.substring(o.length,s.length)}return""}();const o=new n.Modal("#site-selector",{keyboard:!1});""!==e&&null!==e||(console.log(o),o.show(),l("site_selector",1))}(),jQuery("form#study-case-filter").on("change",(function(){var e=jQuery("form#study-case-filter select#category").val(),o=jQuery("form#study-case-filter select#month").val(),t=jQuery("form#study-case-filter select#year").val();l("study-case-category",e),l("study-case-month",o),l("study-case-year",t),jQuery("#reset").removeClass("d-none").addClass("d-block"),c(),u(e,o,t,"ajax_case_studies_load","https://www.nortia.fr/nos-analyses-dexperts/"),d(e,"ajax_case_studies_title_load")})),jQuery("form#blog-filter").on("change",(function(){var e=jQuery("form#blog-filter select#category").val(),o=jQuery("form#blog-filter select#month").val(),t=jQuery("form#blog-filter select#year").val();l("category",e),l("month",o),l("year",t),jQuery("#reset").removeClass("d-none").addClass("d-block"),c(),u(e,o,t,"ajax_posts_load","https://www.nortia.fr/actualite-nortia/"),d(e,"ajax_posts_title_load")})),jQuery("form#study-case-filter #reset a").on("click",(function(){var e="all";l("study-case-category",e),l("study-case-month","all"),l("study-case-year","all"),jQuery("#reset").removeClass("d-block").addClass("d-none"),c(),u(e,"all","all","ajax_case_studies_load","https://www.nortia.fr/nos-analyses-dexperts/"),d(e,"ajax_case_studies_title_load")})),jQuery("form#blog-filter #reset a").on("click",(function(){var e="all";l("category",e),l("month","all"),l("year","all"),jQuery("#reset").removeClass("d-block").addClass("d-none"),c(),d(e,"ajax_posts_title_load"),u(e,"all","all","ajax_posts_load","https://www.nortia.fr/actualite-nortia/")})),o=jQuery(".slideshow-related-news"),jQuery(".slideshow",o).slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:3,slidesToScroll:1,responsive:[{breakpoint:1024,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]}),function(){var e=jQuery(".slideshow-news"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-products"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-text"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-needs"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-awards"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-case-studies"),o=jQuery(".slideshow",e);o.slick({infinite:!1,dots:!1,arrows:!1,centerMode:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){o.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){o.slick("slickNext")}))}(),function e(){jQuery(".navbar-mobile li.menu-item-has-children a").on("click",(function(o){o.preventDefault();var t=jQuery(this).text(),s=jQuery.trim(t);jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"GET",data:{parent:s,action:"ajax_submenu_mobile"},error:function(){},success:function(e){jQuery("#menu-mobile-data").replaceWith(e)},complete:function(){jQuery("#menu-mobile-data a.reset").on("click",(function(o){o.preventDefault();jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"GET",data:{action:"ajax_submenu_mobile_reset"},error:function(){},success:function(e){jQuery("#menu-mobile-data").replaceWith(e)},complete:function(){e(),y()}})})),y()}})}))}(),t=window,s=document,r=s.documentElement,i=s.getElementsByTagName("body")[0],a=function(){var e,o,s;e=t.pageYOffset||i.scrollTop,o=/(nav-is-stuck)/i,s=r.className.match(o),e>0&&!s&&(r.className=r.className+" nav-is-stuck",i.style.paddingTop="0"),e<2&&s&&(r.className=r.className.replace(o,""),i.style.paddingTop="0"),e<2&&s&&(r.className=r.className.replace(o,""),i.style.paddingTop="0")},t.addEventListener("scroll",(function(){t.requestAnimationFrame(a)})),function(){let e=document.querySelector("button#geolocation"),o=document.querySelector("input#locationField");e&&e.addEventListener("click",(function(){"geolocation"in navigator?navigator.geolocation.getCurrentPosition(t):console.log("Geolocation is not supported by this browser.")}));const t=e=>{let t=e.coords.latitude,s=e.coords.longitude,n="https://maps.googleapis.com/maps/api/geocode/json?latlng=".concat(t,",").concat(s,"&key=AIzaSyCcO_gEq7lWm1Sdu12YB2u2v3Mr-qKiz44");fetch(n).then((e=>e.json())).then((e=>{let t=e.results[0].formatted_address;o.value=t}))}}(),jQuery("input#toggle-a").on("click",(function(){setTimeout((function(){document.location.href="https://www.nortia.fr/"}),400)})),jQuery(".nav-link.dropdown-toggle").on("hover",(function(){jQuery(this).addClass("show")})),jQuery(".nav-link.dropdown-toggle").on("mouseleave",(function(){jQuery(this).removeClass("show")})),jQuery(".dropdown-menu").on("hover",(function(){jQuery(this).parent().children().addClass("show")})),jQuery(".dropdown-menu").on("mouseleave",(function(){jQuery(this).parent().children().removeClass("show")}))};(0,s.Z)(r)},713:function(){},567:function(e){e.exports=window.jQuery}},function(e){var o=function(o){return e(e.s=o)};e.O(0,[575,70,459],(function(){return o(537),o(713)})),e.O()}]);