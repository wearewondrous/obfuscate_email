jQuery(function ($) {
  'use strict';

  var $mailItems = $('a[data-mail-to]');

  if (!$mailItems.length) {
    return;
  }

  // + Jonas Raoni Soares Silva
  // @ http://jsfromhell.com/string/rot13 [rev. #1]

  String.prototype.rot13 = function () {
    return this.replace(/[a-zA-Z]/g, function (c) {
      return String.fromCharCode((c <= 'Z' ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
    });
  };

  $mailItems.each(function() {
    var $this = $(this);
    var href = $this.data('mail-to').rot13();

    href = href.replace(/\/dot\//g, '.');
    href = href.replace(/\/at\//g, '@');

    $this
      .attr('href', 'mailto:' + href)
      .removeAttr('data-mail-to');

    if ($this.data('replace-inner') !== undefined) {
      $this.html(href);
    }
  });
});
