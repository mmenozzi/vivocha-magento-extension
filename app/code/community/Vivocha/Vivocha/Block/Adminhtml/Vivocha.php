<?php
class Vivocha_Vivocha_Block_Adminhtml_Vivocha extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  
  public function __construct()
  {
	   $this->_controller = 'adminhtml_vivocha';
	   $this->_blockGroup = 'vivocha';
	   $this->_headerText = Mage::helper('vivocha')->__('Vivocha Configuration');
	   

	   $this->_addButtonLabel = Mage::helper('vivocha')->__('Request Account');
	   
	   $this->_addButton('save', array(
	     'label'     => Mage::helper('vivocha')->__('Save Account'),
	     'onclick'   => "document.forms['vvc_acct_form'].submit()",
	     'class'     => 'save',
	   ));
	   
	    $this->_addButton('reset', array(
	     'label'     => Mage::helper('vivocha')->__('Reset'),
	     //'onclick'   => "document.forms['vvc_acct_form'].submit()",
	     'class'     => 'reset',
	   ));
	   
	   $this->addData(array(
	     'cache_lifetime' => null,
	   ));

	   parent::__construct();
  }
}