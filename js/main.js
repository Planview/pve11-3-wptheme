jQuery(document).ready(function ($) {
  var $body = $('body');
  if ($body.hasClass('home') && $body.hasClass('not-logged-in')) {
    $.stellar({
      horizontalScrolling: false,
      verticalOffset: 40
    });
  }
});
