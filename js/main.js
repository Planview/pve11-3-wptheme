jQuery(document).ready(function ($) {
  var $body = $('body');
  if ($body.hasClass('home') && !$('html').hasClass('lt-ie9')) {
    $.stellar({
      horizontalScrolling: false,
      verticalOffset: 40
    });
  }

  if ($('html').hasClass('lt-ie9')) {
    $(function() {
        var $ss = $('#pve_113-style-css');
        $ss[0].href = $ss[0].href;
    });
  }

  if (!$('html').hasClass('lt-ie10')) {
    var headroomOptions = {
      offset: 100,
      tolerance: 5,
      onUnpin: function () {
        $('.dropdown.open .dropdown-toggle').dropdown('toggle');
      }
    };

    $('#header').headroom(headroomOptions);

    $('#survey').headroom(headroomOptions);
    $('#survey').on('mouseover', function () {
      $(this).find('.survey-text').animate({'width': 140}, 400);
    }).on('mouseleave', function () {
      $(this).find('.survey-text').animate({'width': 0}, 400);
    });
  }

  $(window).on('resize', _.throttle(function (e) {
    $('.limelight-video-respond').each(function () {
      var $wrapper = $(this),
          $video = $(this).find('*[width]'),
          controlsHeight = $(this).data('controlsHeight') || 0,
          controlsWidth = $(this).data('controlsWidth') || 0,
          newHeight,
          newWidth;

      //  See if we have the aspect ratio already
      if ( ! $wrapper.data('aspectRatio') ) {
        var aspectRatio = ( $video.attr('height') - controlsHeight ) /
          ( $video.attr('width') - controlsWidth );
        $wrapper.data('aspectRatio', aspectRatio );
      }

      newWidth = $wrapper.width();
      newHeight = (newWidth - controlsWidth) * $wrapper.data('aspectRatio') + controlsHeight;

      $video.attr('height', newHeight);
      $video.attr('width', newWidth);
    });
  }, 100));
  $(window).trigger('resize');

  $(document).on('gform_post_render',function(){
    $('.gfield').each(function(){
      $(this).find('input, textarea, select').not('input[type="checkbox"], input[type="radio"]').addClass('form-control');
    });
    $('.gfield_checkbox, .gfield_radio').find('input[type="checkbox"], input[type="radio"]').each(function(){
      var sib = $(this).siblings('label');
      $(this).prependTo(sib);
    }).end().each(function(){
      $(this).after('<span class="help-block"></span>');
      if($(this).is('.gfield_checkbox')){
        $(this).addClass('checkbox');
      } else {
        $(this).addClass('radio');
      }
    });
  });

	//-- fancybox image pop-up
	if ( jQuery('a.pop-up').length ) { //if exists
		jQuery("a.pop-up").fancybox({
            'title'				: this.title,
			'titleShow'			: true,
			'titlePosition'		: 'inside',
        	'openEffect'		: 'elastic',
            'closeEffect'		: 'elastic'
        });
	}
	//-- fancybox iframe pop-up (used for youtube videos)
	if ( jQuery('a.pop-up-iframe').length ) { //if exists
		jQuery("a.pop-up-iframe").fancybox({
			'width'				: '100%', //480 = actual limelight player width
			'height'			: '100%', //321 = actual limelight player height
        	'maxWidth'			: 800,
			'maxHeight'			: 600,
        	'titleShow'			: false,
			'titleShow'			: true,
			'titlePosition'		: 'inside',
        	'openEffect'		: 'elastic',
			'closeEffect'		: 'elastic',
			'type'				: 'iframe'
		});
		// style the fancybox iframe pop-up (used for youtube videos)
		$("body").on('click', 'a.pop-up-iframe', function() {
			$( "div#fancybox-title" ).css( "margin-left", "0" );
			$( "div#fancybox-title" ).css( "margin-right", "0" );
		});
	}	
	//-- fancybox iframe pop-up (used for limelight videos)
	if ( jQuery('a.pop-up-video').length ) { //if exists	
		jQuery("a.pop-up-video").fancybox({
        	'width'				: getCurrentWindowWidth(), //$(window).width(), 800 = actual limelight player width
			'height'			: getCurrentWindowHeight(), //$(window).height(), 450 = actual limelight player height
        	'autoStart'     	: true,
			'autoplay'     		: true,
			'autoScale'     	: true,
        	'href'				: this.href,
			'titleShow'			: false,
			'titleShow'			: true,
			'titlePosition'		: 'inside',
        	'openEffect'		: 'elastic',
			'closeEffect'		: 'elastic',
			'type'				: 'iframe',
			'onStart' 			: function() {                    
            						this.width = getCurrentWindowWidth();
									this.height = getCurrentWindowHeight();
        						}
		});
		// style the fancybox iframe pop-up (used for limelight videos)
		$("#fancybox-content").css({
				"background-color" : "#FFFFFF"
		});
		$("body").on('click', 'a.pop-up-video', function(event) {
			$( "div#fancybox-title" ).css( "margin-left", "0" );
			$( "div#fancybox-title" ).css( "margin-right", "0" );
		});
	}
	//-- dynamically updates the width and height attributes of the limelight player
	$(window).on('resize', _.throttle(function (e) {
		$( "a.pop-up-video" ).each(function() {
			var href = $( this ).attr('href');
			var width = ($(window).width()-140);
			if (width < 100) { width = 100; }
			var height = ($(window).height()-140);
			var hrefNewWidth = replaceUrlParam(href, 'width', width);
			var hrefNewWidthAndHeight = replaceUrlParam(hrefNewWidth, 'height', height);
			$( this ).attr('href',hrefNewWidthAndHeight);
		});
	}, 100));
	$(window).trigger('resize');
	function getCurrentWindowHeight() { return $(window).height(); }
	function getCurrentWindowWidth() { return $(window).width(); }
	//-- replaces the width and height parameter values in the limelight urls
	//-- which is needed to set the width and height attributes of the limelight player
	function replaceUrlParam(url, paramName, paramValue){
		var pattern = new RegExp('('+paramName+'=).*?(&|$)');
		var newUrl=url;
		if(url.search(pattern)>=0) {
			newUrl = url.replace(pattern,'$1' + paramValue + '$2');
		} else {
			newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
		}
		return newUrl;
	}
	//-- fancybox iframe pop-up (used for text pop-ups)
	if ( jQuery('a.pop-up-text').length ) { //if exists
		jQuery('a.pop-up-text').fancybox({
			'maxWidth'			: 800,
			'maxHeight'			: 600,
        	'title'				: this.title,
			'titleShow'			: true,
			'titlePosition'		: 'inside',
        	'openEffect'		: 'elastic',
			'closeEffect'		: 'elastic',
			'type'				: 'iframe'
		});
		// style the fancybox iframe pop-up (used for text pop-ups)
		$("body").on('click', 'a.pop-up-text', function() {
			$( "div#fancybox-title" ).css( "margin-left", "0" );
			$( "div#fancybox-title" ).css( "margin-right", "0" );
		});
	}
	//-- fancybox iframe pop-up (used for text pop-ups within image maps)
	if ( jQuery('area.pop-up-text').length ) { //if exists
		jQuery('area.pop-up-text').fancybox({
			'openEffect'		: 'elastic',
			'closeEffect'		: 'elastic',
			'title'				: this.title,
			'titleShow'			: true,
			'titlePosition'		: 'inside',
        	'type'				: 'iframe',
			'height'			: '50%'
		});
		// style the fancybox iframe pop-up (used for text pop-ups within image maps)
		$("body").on('click', 'area.pop-up-text', function() {
			$( "div#fancybox-title" ).css( "margin-left", "0" );
			$( "div#fancybox-title" ).css( "margin-right", "0" );
		});
	}
	//-- fancybox swf pop-up
	if ( jQuery('a.pop-up-swf').length ) { //if exists
		jQuery("a.pop-up-swf").fancybox({
			'maxWidth'			: 800,
			'maxHeight'			: 600,
		    'padding'           : 0,
			'autoScale'     	: true,
    	    'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});	
		// style the swf pop-up
		$("body").on('click', 'a.pop-up-swf', function() {
			$( "div#fancybox-title" ).css( "margin-left", "0" );
			$( "div#fancybox-title" ).css( "margin-right", "0" );
		});
	}

	// History.js updates header release tabs in library
	$('nav.resources-tabs a').click(function(e){
		History.replaceState({}, '', '#tab-' + $(this).attr('href').substring(1));
	});
	// If we're coming in from a # bookmark from resources-tabs, let's click it.
	var hashURL = window.location.hash;
	if (hashURL.substring(0,5) == '#tab-') {
		$('nav.resources-tabs a[href="#' + hashURL.substring(5) + '"]').trigger('click');
	}

});
