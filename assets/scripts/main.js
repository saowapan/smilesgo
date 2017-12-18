/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.


// Checkbox 
(function($) {
  $(".search_treatment_all").click(function() {
    $(".search_treatment").attr("checked", false);
  });
  $(".search_treatment").click(function() {
    $(".search_treatment_all").attr("checked", false);
  });
  $(".search_county_all").click(function() {
    $(".search_county").attr("checked", false);
  });
  $(".search_county").click(function() {
    $(".search_county_all").attr("checked", false);
  });
})(jQuery);

// Ribbon
(function($) {
  setTimeout(function() {
    $('.ribbon').addClass('active');
  }, 500);
})(jQuery);

//Scroll
(function($) {
    $('body').scrollspy({target: ".navbar", offset: 50});
    $("#myNavbar ul li a[href^='#']").on('click', function(e) {

       // prevent default anchor click behavior
       e.preventDefault();

       // store hash
       var hash = this.hash;

       // animate
       $('html, body').animate({
           scrollTop: $(hash).offset().top
         }, 300, function(){

           // when done, add hash to url
           // (default click behaviour)
           window.location.hash = hash;
         });
    });
})(jQuery);

// Star 
(function($) {
    var qualityID = 'qualitylog',
    quality = $('<td id="'+qualityID+'"></td>');
    $('.star-review-quality').append(quality);
      $('.star-review-quality [type*="radio"]').change(function () {
        var quality_out = $(this);
        quality.html(quality_out.attr('value'));
      });

    var serviceID = 'servicelog',
    service = $('<td id="'+serviceID+'"></td>');
    $('.star-review-service').append(service);
      $('.star-review-service [type*="radio"]').change(function () {
        var service_out = $(this);
        service.html(service_out.attr('value'));
      });
      
    var cleanlinessID = 'cleanlinesslog',
    cleanliness = $('<td id="'+cleanlinessID+'"></td>');
    $('.star-review-cleanliness').append(cleanliness);
      $('.star-review-cleanliness [type*="radio"]').change(function () {
        var cleanliness_out = $(this);
        cleanliness.html(cleanliness_out.attr('value'));
      });

    var comfortID = 'comfortlog',
    comfort = $('<td id="'+comfortID+'"></td>');
    $('.star-review-comfort').append(comfort);
      $('.star-review-comfort [type*="radio"]').change(function () {
        var comfort_out = $(this);
        comfort.html(comfort_out.attr('value'));
      });

    var communID = 'communlog',
    commun = $('<td id="'+communID+'"></td>');
    $('.star-review-commun').append(commun);
      $('.star-review-commun [type*="radio"]').change(function () {
        var commun_out = $(this);
        commun.html(commun_out.attr('value'));
      });  

    var valuesID = 'valueslog',
    values = $('<td id="'+valuesID+'"></td>');
    $('.star-review-values').append(values);
      $('.star-review-values [type*="radio"]').change(function () {
        var values_out = $(this);
        values.html(values_out.attr('value'));
      }); 
})(jQuery);

//Converter Button     
(function($) {
    $(".aud").hide();
    $(".valaud").hide();
    
    $(".aud").click(function(){
        $(".thb").show();
        $(".aud").hide();
        $(".valthb").show();
        $(".valaud").hide();    
        $(".currencyTA").text("THB");
       
    });
    $(".thb").click(function(){
        $(".aud").show();
        $(".thb").hide();
        $(".valaud").show();
        $(".valthb").hide();
        $(".currencyTA").text("AUD");
    });
})(jQuery);

// Search placeholder input
(function($) {
  $('.search-form input[type="search"]').attr('placeholder','Find a clinic');
})(jQuery);