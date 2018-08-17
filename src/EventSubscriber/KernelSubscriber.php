<?php

namespace Drupal\term_controller\EventSubscriber;

use Drupal\Core\Routing\RouteMatch;
use Drupal\term_controller\ControlSwitcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Sets the entity for a term http request.
 */
class KernelSubscriber implements EventSubscriberInterface {

  /**
   * The control switcher
   *
   * @var \Drupal\term_controller\ControlSwitcher
   */
  protected $switcher;

  /**
   * KernelSubscriber constructor.
   *
   * @TODO: ControlSwitcherInterface
   * @param \Drupal\term_controller\ControlSwitcher $switcher
   */
  public function __construct(ControlSwitcher $switcher) {
    $this->switcher = $switcher;
  }

  /**
   *
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    //var_dump($event->getRequest()->attributes->get('_controller')); exit;
    //$event->getRequest()->attributes->add(['_disable_route_normalizer' => TRUE]);
    //var_dump(__LINE__);
  }

  /**
   *
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
   *   The Event to process.
   */
  public function onController(FilterControllerEvent $event) {


    return;

//var_dump(__FILE__); exit;

    //var_dump($event->getController()); exit;

    $route_match = RouteMatch::createFromRequest($event->getRequest());
    // See if the controller needs switching if this is a term page.
    //if ($route_match->getRouteName() == 'entity.taxonomy_term.canonical') {
      $controller = $this->switcher->getController($route_match);
    //}


    //var_dump($controller); exit;
    $event->setController($controller);
  }


  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('onRequest', 50);

    // Run after EarlyRenderingControllerWrapperSubscriber
    // as it bypasses the HttpKernel argumentResolver
    $events[KernelEvents::CONTROLLER][] = array('onController', -50);
    return $events;
  }

}
