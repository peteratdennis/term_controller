<?php

namespace Drupal\term_controller;

use Drupal\Core\Controller\ControllerResolverInterface;
use Drupal\Core\Routing\RouteMatchInterface;

class ControlSwitcher {

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  public function __construct(ControllerResolverInterface $resolver) {
    $this->resolver = $resolver;

  }

  /**
   *
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match.
   */
  public function setRouteMatch(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  public function getController(RouteMatchInterface $route_match) {
    $this->setRouteMatch($route_match);

    //var_dump($this->routeMatch); exit;
    //var_dump($this->resolver); exit;

    $controller = '\Drupal\node\Controller\NodeViewController::view';
    return $this->resolver->getControllerFromDefinition($controller);

  }

}
