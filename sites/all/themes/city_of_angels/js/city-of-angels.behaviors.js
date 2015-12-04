(function ($) {

  /**
   * The recommended way for producing HTML markup through JavaScript is to write
   * theming functions. These are similiar to the theming functions that you might
   * know from 'phptemplate' (the default PHP templating engine used by most
   * Drupal themes including Omega). JavaScript theme functions accept arguments
   * and can be overriden by sub-themes.
   *
   * In most cases, there is no good reason to NOT wrap your markup producing
   * JavaScript in a theme function.
   */
  Drupal.theme.prototype.cityOfAngelsExampleButton = function (path, title) {
    // Create an anchor element with jQuery.
    return $('<a href="' + path + '" title="' + title + '">' + title + '</a>');
  };

  /**
   * Behaviors are Drupal's way of applying JavaScript to a page. In short, the
   * advantage of Behaviors over a simple 'document.ready()' lies in how it
   * interacts with content loaded through Ajax. Opposed to the
   * 'document.ready()' event which is only fired once when the page is
   * initially loaded, behaviors get re-executed whenever something is added to
   * the page through Ajax.
   *
   * You can attach as many behaviors as you wish. In fact, instead of overloading
   * a single behavior with multiple, completely unrelated tasks you should create
   * a separate behavior for every separate task.
   *
   * In most cases, there is no good reason to NOT wrap your JavaScript code in a
   * behavior.
   *
   * @param context
   *   The context for which the behavior is being executed. This is either the
   *   full page or a piece of HTML that was just added through Ajax.
   * @param settings
   *   An array of settings (added through drupal_add_js()). Instead of accessing
   *   Drupal.settings directly you should use this because of potential
   *   modifications made by the Ajax callback that also produced 'context'.
   */
  Drupal.behaviors.cityOfAngelsExampleBehavior = {
    attach: function (context, settings) {
      // By using the 'context' variable we make sure that our code only runs on
      // the relevant HTML. Furthermore, by using jQuery.once() we make sure that
      // we don't run the same piece of code for an HTML snippet that we already
      // processed previously. By using .once('foo') all processed elements will
      // get tagged with a 'foo-processed' class, causing all future invocations
      // of this behavior to ignore them.
      $('.some-selector', context).once('foo', function () {
        // Now, we are invoking the previously declared theme function using two
        // settings as arguments.
        var $anchor = Drupal.theme('cityOfAngelsExampleButton', settings.myExampleLinkPath, settings.myExampleLinkTitle);

        // The anchor is then appended to the current element.
        $anchor.appendTo(this);
      });
    }
  };
  
  
  $(document).ready(function(){

     /*   alert($(window).width() + ' got here' + $base_url);*/
    
    
	$('.field-name-field-fourup .inlinefourup a img').jcaption({
	  wrapperElement: 'div',
		copyStyle: true,
		animate: true,
		show: {height: "show"},
		hide: {height: "hide"}
	});
	
		$('.field-name-field-rightbig a img').jcaption({
		wrapperElement: 'div',
		copyStyle: true,
		animate: true,
		show: {height: "show"},
		hide: {height: "hide"}
	});

/*var realurl = $('.field-name-field-rightbig a img').attr('title');
var realurlsmall = $('.inlinefourup a img').attr('title');
$('.field-name-field-rightbig a').prop("href", realurl);*/




$('.field-name-field-rightbig').each( function( index, element ){
    var realurlbig = $(this).children("a").children(".caption").children("img").attr('title');
     $(this).children("a").prop("href",'/dev/los-angeles-web-design/' + realurlbig);
  /* $(this).children("a").data("href",'/dev/los-angeles-web-design/' + realurlbig);*/
    $(this).children("a").attr("onclick",'window.location=/dev/los-angeles-web-design/' + realurlbig);
});

$('.inlinefourup').each( function( index, element ){
    var realurltiny = $(this).children("a").children(".caption").children("img").attr('title');
   $(this).children("a").prop("href",'/dev/los-angeles-web-design/' + realurltiny);
    /* $(this).children("a").data("href",'/dev/los-angeles-web-design/' + realurltiny);*/
   /* $(this).children("a").attr("href",'/dev/los-angeles-web-design/' + realurltiny);*/
    $(this).children("a").attr("onclick",'window.location=/dev/los-angeles-web-design/' + realurltiny);
});


$('.field-name-field-fourup .inlinefourup a .caption img').each(function(i, item) {
    var img_height = $(item).height();
    var div_height = $(item).parent().height();
    if(img_height<div_height){
        //IMAGE IS SHORTER THAN CONTAINER HEIGHT - CENTER IT VERTICALLY
        var newMargin = (div_height-img_height)/2+'px';
        $(item).css({'margin-top': newMargin });
    }else if(img_height>div_height){
        //IMAGE IS GREATER THAN CONTAINER HEIGHT - REDUCE HEIGHT TO CONTAINER MAX - SET WIDTH TO AUTO  
        $(item).css({'width': 'auto', 'height': '100%'});
        //CENTER IT HORIZONTALLY
        var img_width = $(item).width();
        var div_width = $(item).parent().width();
        var newMargin = (div_width-img_width)/2+'px';
        $(item).css({'margin-left': newMargin});
    }
});

$('.field-name-field-rightbig a .caption img').each(function(i, item) {
    var img_height = $(item).height();
    var div_height = $(item).parent().height();
    if(img_height<div_height){
        //IMAGE IS SHORTER THAN CONTAINER HEIGHT - CENTER IT VERTICALLY
        var newMargin = (div_height-img_height)/2+'px';
        $(item).css({'margin-top': newMargin });
    }else if(img_height>div_height){
        //IMAGE IS GREATER THAN CONTAINER HEIGHT - REDUCE HEIGHT TO CONTAINER MAX - SET WIDTH TO AUTO  
        $(item).css({'width': 'auto', 'height': '100%'});
        //CENTER IT HORIZONTALLY
        var img_width = $(item).width();
        var div_width = $(item).parent().width();
        var newMargin = (div_width-img_width)/2+'px';
        $(item).css({'margin-left': newMargin});
    }
});


});

})(jQuery);
