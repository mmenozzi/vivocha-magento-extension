<?php

class Vivocha_Vivocha_Block_Adminhtml_Vivocha_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('vivochaGrid');
      $this->setDefaultSort('date_added');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
      
      $this->addData(array(
	     'cache_lifetime' => null,
	   ));
  } 
}