"use strict";(self.webpackChunksage=self.webpackChunksage||[]).push([[143],{537:function(e,t,o){var n=o(575),s=(o(567),o(138));o(459),o(129),window.bootstrap=o(138);const c=async e=>{var t;function o(e,t){const o=new Date;o.setTime(o.getTime()+36e5);const n="; expires="+o.toGMTString();0===t.length?document.cookie="".concat(e,"=").concat(JSON.stringify(t),";expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/"):document.cookie="".concat(e,"=").concat(JSON.stringify(t)).concat(n,"; path=/")}function n(){const e=document.querySelector("input#pagination");e&&e.value>1&&window.location.replace("/blog/")}function c(e,t,o,n,s){jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"POST",data:{pageurl:s,month:t,year:o,category:e,action:n},beforeSend:function(){jQuery("#ajaxLoader").fadeIn("slow")},error:function(){},success:function(e){jQuery("#results").replaceWith(e),jQuery("#ajaxLoader").fadeOut("slow")}})}function r(e,t){jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"POST",data:{category:e,action:t},beforeSend:function(){},error:function(){},success:function(e){jQuery("#wrapper-blog-filter #title").replaceWith(e)}})}function i(){jQuery(".navbar-mobile li.menu-item-type-taxonomy a").removeAttr("href")}e&&console.error(e),jQuery("#loadMore").on("click",(function(){var e=jQuery(this),t=e.data("page"),o=t+1,n=e.data("url"),s=e.data("lat"),c=e.data("lng");jQuery.ajax({url:n,type:"POST",data:{page:t,lat:0!=s?s:"",lng:0!=c?c:"",action:"ajax_script_load_more_cgp"},error:function(e){console.log(e)},success:function(t){0==t?jQuery("#cgp-results").append('<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>'):(console.log(o),e.data("page",o),jQuery("#cgp-results").append(t))}})})),function(){const e=function(e){const t="".concat("site_selector","="),o=document.cookie.split(";");for(const e of o){const o=e.trim();if(o.startsWith(t))return o.substring(t.length)}return""}(),t=new s.Modal(document.querySelector("#site-selector"),{keyboard:!1});e||(t.show(),o("site_selector",1))}(),function(){const e=document.querySelector("form#study-case-filter");e&&e.addEventListener("change",(()=>{const t=e.querySelector("select#category").value,s=e.querySelector("select#month").value,i=e.querySelector("select#year").value;o("study-case-category",t),o("study-case-month",s),o("study-case-year",i);const l=document.querySelector("#reset");l.classList.remove("d-none"),l.classList.add("d-block"),n(),c(t,s,i,"ajax_case_studies_load","https://www.nortia.fr/nos-analyses-dexperts/"),r(t,"ajax_case_studies_title_load")}))}(),function(){const e=document.querySelector("form#blog-filter");e&&e.addEventListener("change",(()=>{const t=e.querySelector("select#category").value,s=e.querySelector("select#month").value,i=e.querySelector("select#year").value;o("category",t),o("month",s),o("year",i);const l=document.querySelector("#reset");l.classList.remove("d-none"),l.classList.add("d-block"),n(),c(t,s,i,"ajax_posts_load","https://www.nortia.fr/actualite-nortia/"),r(t,"ajax_posts_title_load")}))}(),function(){const e=document.querySelector("form#study-case-filter"),t=e?e.querySelector("#reset a"):null;t&&t.addEventListener("click",(()=>{const e="all";o("study-case-category",e),o("study-case-month","all"),o("study-case-year","all");const t=document.querySelector("#reset");t.classList.remove("d-block"),t.classList.add("d-none"),n(),c(e,"all","all","ajax_case_studies_load","https://www.nortia.fr/nos-analyses-dexperts/"),r(e,"ajax_case_studies_title_load")}))}(),function(){const e=document.querySelector("form#blog-filter"),t=e?e.querySelector("#reset a"):null;t&&t.addEventListener("click",(()=>{const e="all";o("category",e),o("month","all"),o("year","all");const t=document.querySelector("#reset");t.classList.remove("d-block"),t.classList.add("d-none"),n(),r(e,"ajax_posts_title_load"),c(e,"all","all","ajax_posts_load","https://www.nortia.fr/actualite-nortia/")}))}(),function(){const e=document.querySelectorAll(".nav-link.dropdown-toggle"),t=document.querySelectorAll(".dropdown-menu");e.forEach((e=>{e.addEventListener("mouseenter",(()=>{e.classList.add("show")})),e.addEventListener("mouseleave",(()=>{e.classList.remove("show")}))})),t.forEach((e=>{e.addEventListener("mouseenter",(()=>{Array.from(e.parentElement.children).forEach((e=>{e.classList.add("show")}))})),e.addEventListener("mouseleave",(()=>{Array.from(e.parentElement.children).forEach((e=>{e.classList.remove("show")}))}))}))}(),t=jQuery(".slideshow-related-news"),jQuery(".slideshow",t).slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:3,slidesToScroll:1,responsive:[{breakpoint:1024,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]}),function(){var e=jQuery(".slideshow-news"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-products"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-text"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-needs"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-awards"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function(){var e=jQuery(".slideshow-case-studies"),t=jQuery(".slideshow",e);t.slick({infinite:!1,dots:!1,arrows:!1,centerMode:!1,slidesToShow:1,slidesToScroll:1}),jQuery(".slick-arrow-prev",e).on("click",(function(){t.slick("slickPrev")})),jQuery(".slick-arrow-next",e).on("click",(function(){t.slick("slickNext")}))}(),function e(){jQuery(".navbar-mobile li.menu-item-has-children").on("click",(function(e){e.preventDefault()})),jQuery(".navbar-mobile li.menu-item-has-children a").on("click",(function(t){t.preventDefault();var o=jQuery(this).text().trim();jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"GET",data:{parent:o,action:"ajax_submenu_mobile"},error:function(){},success:function(e){jQuery("#menu-mobile-data").replaceWith(e)},complete:function(){jQuery("#menu-mobile-data a.reset").on("click",(function(t){t.preventDefault();jQuery.ajax({url:"/wp/wp-admin/admin-ajax.php",type:"GET",data:{action:"ajax_submenu_mobile_reset"},error:function(){},success:function(e){jQuery("#menu-mobile-data").replaceWith(e)},complete:function(){e(),i()}})})),i()}})}))}(),function(){const e=document.documentElement,t=document.querySelector("body"),o=/(nav-is-stuck)/i,n=()=>{(()=>{const n=window.pageYOffset||t.scrollTop,s=e.className.match(o);n>0&&!s?(e.classList.add("nav-is-stuck"),t.style.paddingTop="0"):n<2&&s&&(e.classList.remove("nav-is-stuck"),t.style.paddingTop="0")})()};window.addEventListener("scroll",(()=>{window.requestAnimationFrame(n)}))}(),function(){let e=document.querySelector("button#geolocation"),t=document.querySelector("input#lat"),o=document.querySelector("input#lng"),n=document.querySelector("form#cgp-locator");e&&e.addEventListener("click",(function(e){e.preventDefault(),"geolocation"in navigator?navigator.geolocation.getCurrentPosition(s):console.log("Geolocation is not supported by this browser.")}));const s=e=>{t.value=e.coords.latitude,o.value=e.coords.longitude,n.submit()}}(),function(){let e=document.querySelector("input#locationField");if(e){let t=new google.maps.places.Autocomplete(e,{types:["geocode"],componentRestrictions:{country:["fr","nc","mq","pf"]}});t.setFields(["address_component","geometry"]),t.addListener("place_changed",(function(){let e=t.getPlace(),o=document.querySelector("input#lat"),n=document.querySelector("input#lng");o.value=e.geometry.location.lat(),n.value=e.geometry.location.lng()}))}}(),document.querySelector("input#toggle-b").addEventListener("click",(function(){setTimeout((function(){window.location.href="https://www.nortia.fr/"}),400)}))};(0,n.Z)(c)},713:function(){},567:function(e){e.exports=window.jQuery}},function(e){var t=function(t){return e(e.s=t)};e.O(0,[575,138,459],(function(){return t(537),t(713)})),e.O()}]);