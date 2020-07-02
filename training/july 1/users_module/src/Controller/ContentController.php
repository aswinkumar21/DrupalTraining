<?php 

namespace Drupal\users_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class ContentController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [
      '#markup' => $this->t('Hello Drupal.. This is my 1st custom module!'),
    ];
    return $build;
  }

   public function userDisplay($uid) {
	 
	   
	
	$userdata =  db_select('details', 'x')
	  ->fields('x', array('id','firstname','lastname','bio','gender'))
	  ->condition('uid', $uid)
	  ->execute()
	  ->fetchAll();
  
	$userdata = json_decode(json_encode($userdata), true);
	// print_r($userdata[0]);die;
	
	/* if(!empty($userdata))  { 
	 */
		return [
		  '#theme' => 'my_table',
		  '#userdata' => $userdata[0],
		];
	/* } else {
		$build = [
			'#title' => $this->t('Error'),
			'#markup' => $this->t('User Not Found'),
		];
	} */
	
    // return $build;
  }
  
  


}

?>