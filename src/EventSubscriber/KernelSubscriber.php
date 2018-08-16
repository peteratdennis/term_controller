<?php

namespace Drupal\term_controller\EventSubscriber;

use Drupal\Core\Routing\RouteMatch;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Sets the entity for a term http request.
 */
class KernelSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('onRequest', 50);
    $events[KernelEvents::CONTROLLER][] = array('onController', 50);
    return $events;
  }

  /**
   *
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    //var_dump($event->getRequest()->attributes->get('_controller')); exit;
  }

  /**
   *
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
   *   The Event to process.
   */
  public function onController(FilterControllerEvent $event) {
    //var_dump($event->getController()); exit;
    $route_match = RouteMatch::createFromRequest($event->getRequest());
    var_dump($route_match); exit;
  }

}
