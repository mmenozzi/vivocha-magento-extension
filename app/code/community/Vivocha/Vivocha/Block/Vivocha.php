<?php
class Vivocha_Vivocha_Block_Vivocha extends Mage_Core_Block_Template
{
 public function __construct()
  {
	   $this->addData(array(
	     'cache_lifetime' => null,
	   ));

	   //parent::__construct();
  }
	public function _prepareLayout()
  {
		return parent::_prepareLayout();
  }
}