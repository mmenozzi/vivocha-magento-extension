<?php
class Vivocha_Vivocha_Adminhtml_VivochaController extends Mage_Adminhtml_Controller_action
{

	public function indexAction() {
			
		$block = $this->getLayout()->createBlock(
			'Mage_Core_Block_Template',
			'vivocha_config',
			array('template' => 'vivocha/vivocha_config.phtml')
		);
		
		$block->addData(array(
	     'cache_lifetime' => null,
	   ));

		
		$this->loadLayout()
			->_setActiveMenu('vivocha')
			->_addContent($block)
			->renderLayout();
	}
	
	public function newAction() {
	
		$block = $this->getLayout()->createBlock(
			'Mage_Core_Block_Template',
			'vivocha_request',
			array('template' => 'vivocha/vivocha_request.phtml')
		);
		
		$block->addData(array(
	     'cache_lifetime' => null,
	   ));

		
		$this->loadLayout()
			->_setActiveMenu('vivocha')
			->_addContent($block)
			->renderLayout();
	}
	
	
	public function postAction() {	
		//avoid notices warnings
		!isset($_POST['vivocha_account']) ? $vivocha_account = '' : $vivocha_account = $_POST['vivocha_account']; 
		!isset($_POST['vivocha_link']) ? $vivocha_link = 'www.vivocha.com' : $vivocha_link = $_POST['vivocha_link'];
		
		try {
				
  		$config_table = Mage::getSingleton('core/resource')->getTableName('core_config_data');
  		
  		
  		$read = Mage::getSingleton('core/resource')->getConnection('core_read');
  		$query = 'SELECT * FROM ' . $config_table;
  		$query .= ' WHERE scope="default" AND scope_id=0 AND path="vivocha/settings/account"';
  		$results = $read->fetchAll($query);
  
  		$write = Mage::getSingleton('core/resource')->getConnection('core_write');
  
  		//check for existing vivocha account configuration
  		if ($row = array_pop($results)) {
  			$config_id = $row['config_id'];
  			
  			$query = 'UPDATE ' . $config_table;
  			$query .= ' SET value="' . $vivocha_account . '"';
  			$query .= ' WHERE config_id=' . $config_id;
  			$write->query($query);
  			
  			$query = 'UPDATE ' . $config_table;
  			$query .= ' SET value="' . $vivocha_link . '"';
  			$query .= ' WHERE config_id=' . ++$config_id;
  			$write->query($query);
  			
  		} else {
  			$query = 'INSERT INTO ' . $config_table;
  			$query .= ' (scope, scope_id, path, value)';
  			$query .= ' VALUES ("default", 0, "vivocha/settings/account", "' . $vivocha_account . '"),';
  			$query .= ' ("default", 0, "vivocha/settings/world", "' . $vivocha_link . '")'; 
  			$write->query($query);
  		}
		
      Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The Vivocha account has been saved.'));
    
    } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('An error occurred while saving Vivocha account.'));
    }
    Mage::app()->getCacheInstance()->cleanType('config');
    $this->getResponse()->setRedirect($this->getUrl("*/*"));
		
	}		
	
}