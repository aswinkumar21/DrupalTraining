<?php


namespace Drupal\users_module\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Entity\t;
use Drupal\users_module\Event\RedirectEvent;


/**
 * Class Configuration Setting.
 *
 * @package Drupal\users_module\Form
 */
class Details extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {


   $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
    ];
	
	$form['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#required' => TRUE,
    ];
	
	$form['bio'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Bio'),
	  '#required' => TRUE,
    ];

    
    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Gender'),
      '#options' => ['male' => $this->t('Male'), 'female' => $this->t('Female')],
	  '#default_value' =>$this->t('male'),
	  '#required' => TRUE,
    ];

 
	/* $vid = 'interests';
	$terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
	
	foreach ($terms as $term) {
		$term_data[$term->name] = $term->name;
	}
	// echo'<pre>';print_r($term_data);die;
	
	 $form['interest'] = [
	  '#type' => 'select',
	  '#title' => $this->t('Interests'),
	  '#options' => $term_data,
	  '#empty_option' => $this->t('-select interest-'),
	   '#required' => TRUE,
	]; */
 

	 $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
	  /* '#ajax' => [
        'callback' => '::setMessage',
      ], */
    ];

    return $form;
  }

public function setMessage(array $form, FormStateInterface $form_state) {
$response = new AjaxResponse();

 $values = $form_state->getValues();
	
	unset($values['submit']);
	unset($values['form_build_id']);
	unset($values['form_token']);
	unset($values['form_id']);
	unset($values['op']);

	
	$uid = \Drupal::currentUser()->id();
	$uname = \Drupal::currentUser()->getUsername();
	$values['uid']=$uid;
	//	print_r($values);die;
	
    $config = \Drupal::service('users_module.add')->store($values);
	
	
	
	$dispatcher = \Drupal::service('event_dispatcher');
    $event = new RedirectEvent($uid);
    $dispatcher->dispatch(RedirectEvent::EVENT_NAME, $event);
	
	/*  $form_state->setValue('firstname', '');
	$response = new AjaxResponse();
	  $response->addCommand(new ReplaceCommand('#success-msg', "Success! Your message has been sent"));
	$this->messenger()->addMessage('inserted data');
  
    return $response;  */
	
   }

 
  public function getFormId() {
    return 'details_module';
  }

public function validateForm(array &$form, FormStateInterface $form_state) {
     return 'details_module';
  }


  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
		$values = $form_state->getValues();
	
		unset($values['submit']);
		unset($values['form_build_id']);
		unset($values['form_token']);
		unset($values['form_id']);
		unset($values['op']);

		
		$uid = \Drupal::currentUser()->id();
		$uname = \Drupal::currentUser()->getUsername();
		$values['uid']=$uid;
		//	print_r($values);die;
		
		$config = \Drupal::service('users_module.add')->store($values);
		
		
		
		$dispatcher = \Drupal::service('event_dispatcher');
		$event = new RedirectEvent($uid);
		$dispatcher->dispatch(RedirectEvent::EVENT_NAME, $event);
	}

}

















