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
});
