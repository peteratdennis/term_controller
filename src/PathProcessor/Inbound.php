<?php

namespace Drupal\term_controller\PathProcessor;

use Drupal\Core\Path\AliasManagerInterface;
use Drupal\Core\PathProcessor\InboundPathProcessorInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Processes the inbound path using path alias lookups.
 */
class Inbound implements InboundPathProcessorInterface {

  /**
   * An alias manager for looking up the system path.
   *
   * @var \Drupal\Core\Path\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * Constructs a PathProcessorAlias object.
   *
   * @param \Drupal\Core\Path\AliasManagerInterface $alias_manager
   *   An alias manager for looking up the system path.
   */
  public function __construct(AliasManagerInterface $alias_manager) {
    $this->aliasManager = $alias_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function processInbound($path, Request $request) {
    $path = $this->aliasManager->getPathByAlias($path);
    if (strpos($path, '/taxonomy/term/') === 0) {
      $path = '/node/6';
    }

    // Don't use a redirect.
    $request->attributes->add(['_disable_route_normalizer' => TRUE]);
    return $path;
  }

}
