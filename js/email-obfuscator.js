(function (Drupal) {
  'use strict';

  function init(context) {
    var elements = context.querySelectorAll('a[data-mail-to]');

    if (!elements) {
      return;
    }

    // Rewrite from Jonas Raoni Soares Silva
    // @ http://jsfromhell.com/string/rot13 [rev. #1]

    function rot13(string) {
      return string.replace(/[a-zA-Z]/g, function (c) {
        return String.fromCharCode((c <= 'Z' ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
      });
    }

    NodeList.prototype.forEach = Array.prototype.forEach;

    elements.forEach(function (element) {
      var href = rot13(element.getAttribute('data-mail-to'));
      var replaceInner = !!element.getAttribute('data-replace-inner');

      href = href.replace(/\/dot\//g, '.');
      href = href.replace(/\/at\//g, '@');

      element.setAttribute('href', 'mailto:' + href);
      element.removeAttribute('data-mail-to');

      if (replaceInner) {
        element.innerHTML = href;
      }
    });
  }

  Drupal.behaviors.obfuscateEmailField = {
    attach: init
  };
})(Drupal);
