<?php

namespace Drupal\details_module\EventSubscriber;

use Drupal\details_module\Event\LoggerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\details_module\EventSubscriber
 */
class LoggerSubscriber implements EventSubscriberInterface {

 
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
      LoggerEvent::EVENT_NAME => 'logger',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\details_module\Event\LoggerEvent $event
   *   Dat event object yo.
   */
  public function logger(LoggerEvent $event) {
	  $dateFormatter = \Drupal::service('date.formatter');
    // print_r($event->details['bio']);die;
	$created=time();
	
	$date = $dateFormatter->format($created, 'medium');
	
	$this->loggerFactory->get('details_module')->notice("The last inserted data is with name as " . $event->details['firstname'] ." ". $event->details['lastname'] ." with bio ".$event->details['bio'] ." and has interest in ".$event->details['interest'] ." on ".$date.".");
	
	// \Drupal::logger('details_module')->notice("The last inserted data is with name as " . $event->details['firstname'] ." ". $event->details['lastname'] ." with bio ".$event->details['bio'] ." and has interest in ".$event->details['interest'] ." on ".$date.".");
	 
	 
  }

}