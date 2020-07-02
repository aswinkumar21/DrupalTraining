<?php

namespace Drupal\users_module\Event;


use Symfony\Component\EventDispatcher\Event;

/**
 * Event that is fired when a user logs in.
 */
class RedirectEvent extends Event {

  const EVENT_NAME = 'redirect';

  /**
   * The user account.
   *
   * @var \Drupal\user\UserInterface
   */
  public $userid;

  /**
   * Constructs the object.
   *
   * @param \Drupal\user\UserInterface $account
   *   The account of the user logged in.
   */
  public function __construct($userid) {
    $this->userid = $userid;
  }

}