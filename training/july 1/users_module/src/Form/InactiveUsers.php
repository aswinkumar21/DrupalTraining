<?php

namespace Drupal\users_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\user\Entity\User;

/**
 * Class Configuration Setting.
 *
 * @package Drupal\users_module\Form
 */
class InactiveUsers extends FormBase {


public $configid;
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $configid=NULL) {
    
	
	$query = \Drupal::entityQuery('user');
	$query->condition('status', 0);
	$query->condition("uid", 0 , ">");
	$entity_ids = $query->execute();
	$users = \Drupal::entityTypeManager()->getStorage('user')->loadMultiple($entity_ids);
	
	$userdata=[];
	foreach ($users as $key => $node){
        
		 $userdata[$key]['uid']=$node->get('uid')->value;
		 $userdata[$key]['name']=$node->get('name')->value;
		 $userdata[$key]['mail']=$node->get('mail')->value;
		 $userdata[$key]['status']='Not Activated';
		
          
        } 
	

$options =$userdata;

    $header = [
      'uid' => $this->t('User Id'),
      'name' => $this->t('Name'),
      'mail' => $this->t('Email'),
      'status' => $this->t('Status'),
    ];

    $form['table'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('Users'),
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No Data Found'),
    ];
	
	$form['userid']=$configid;
	
    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Activate'),
      '#button_type' => 'primary',
    );
	

    return $form;
  }

     /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('table') == '') {
      $msg = t('<strong>Password is required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }
  
  public function getFormId() {
    return 'form_module';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
	
	$ids=$form_state->getValue('table');
	// echo'<pre>';print_r($ids);die;
	foreach($ids as $key => $value){
		
		
		
		$user = User::load($value);
		$user->set('status',1);
		$user->addRole('user');
		$user->save();
		
		
		
	}
    
   
    drupal_set_message($this->t("@message", ['@message' => 'Users Activated Successfully']));
  }


}
