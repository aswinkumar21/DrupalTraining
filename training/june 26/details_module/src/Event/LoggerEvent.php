<?php

namespace Drupal\details_module\Event;


use Symfony\Component\EventDispatcher\Event;

/**
 * Event that is fired when a user logs in.
 */
class LoggerEvent extends Event {

  const EVENT_NAME = 'logger';

  /**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   */
  public $details;

  /**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */
  public function __construct($details) {
    $this->details = $details;
  }

}