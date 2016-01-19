<?php

/**
 * @file
 * Contains \Drupal\rot13\Twig\Rot13Extension.
 *
 * This provides a Twig extension that registers various Drupal specific
 * extensions to Twig.
 *
 * @see \Drupal\Core\CoreServiceProvider
 */

namespace Drupal\rot13\Twig;

/**
 * A class providing Drupal Twig extensions.
 *
 * Specifically Twig functions, filter and node visitors.
 *
 * @see \Drupal\Core\CoreServiceProvider
 */

class Rot13Extension extends \Twig_Extension {

  /**
   * {@inheritdoc}
   */
  public function getFilters() {
    return array(
        new \Twig_SimpleFilter('rot13', 'str_rot13'),
    );
  }

  public function getName()
  {
    return 'rot13_twig_extension';
  }
}