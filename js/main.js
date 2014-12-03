jQuery(document).ready(function ($) {
  var $body = $('body');
  if ($body.hasClass('home')) {
    $.stellar({
      horizontalScrolling: false,
      verticalOffset: 40
    });
  }

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
