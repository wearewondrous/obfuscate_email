<?php

namespace Drupal\obfuscate_email\Plugin\Filter;

use Drupal\Component\Utility\Html;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to obfuscate mailto anchor tags.
 *
 * @Filter(
 *   id = "obfuscate_email",
 *   title = @Translation("Obfuscate Email"),
 *   description = @Translation("Transforms <code>mailto</code> anchors into obfuscated markup"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE
 * )
 */
class ObfuscateEmail extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);

    if (stristr($text, 'mailto') !== FALSE) {
      $dom = Html::load($text);
      $xpath = new \DOMXPath($dom);
      foreach ($xpath->query('//a[starts-with(@href, "mailto:")]') as $node) {
        // Read the href attribute value, then delete it.
        $href = str_replace('mailto:', '', $node->getAttribute('href'));
        $node->setAttribute('href', '#');

        // Convert to rot13
        $mail_string = str_rot13(str_replace(['.', '@'], ['/dot/', '/at/'], $href));
        $node->setAttribute('data-mail-to', $mail_string);

        // Replace an occurrence of the address in the anchor text
        $node->nodeValue = str_replace($href, '@email', $node->nodeValue);
        $node->setAttribute('data-replace-inner', '@email');
      }

      $result->setProcessedText(Html::serialize($dom));
    }

    return $result;
  }

}
