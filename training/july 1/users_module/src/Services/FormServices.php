<?php

namespace  Drupal\users_module\Services;
use Drupal\Core\Config\ConfigFactoryInterface;


interface ServicesInterface { 
	   public  function store($data); 
}

class FormServices implements ServicesInterface{

 public $data;

public function __construct(ConfigFactoryInterface $config_factory) {
	
   $this->configFactory = $config_factory;
 } 
 
 

 public function  store($data){
	$insert = db_insert('details')
	->fields($data)->execute();
 }
 
  

}