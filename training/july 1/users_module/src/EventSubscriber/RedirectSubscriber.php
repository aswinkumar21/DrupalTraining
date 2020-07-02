<?php

namespace Drupal\users_module\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\users_module\Event\RedirectEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class RedirectSubscriber.
 *
 * @package Drupal\users_module\EventSubscriber
 */
class RedirectSubscriber implements EventSubscriberInterface {

 
  /**
   * Date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
   protected $dateFormatter;
   
    public function __construct($factory) {
    $this->loggerFactory = $factory;
  }
   
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      // Static class constant => method on this class.
      RedirectEvent::EVENT_NAME => 'redirectUser',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\users_module\Event\LoggerEvent $event
   *   Dat event object yo.
   */
  public function redirectUser(RedirectEvent $userid) {
	// print_r($userid->userid);die;
	$uid=$userid->userid;
	$response = new RedirectResponse('/d8new/web/users/'.$uid);
    $response->send(); 
	return $response;
    // print_r($event->details['bio']);die;
	
	 
  }

}