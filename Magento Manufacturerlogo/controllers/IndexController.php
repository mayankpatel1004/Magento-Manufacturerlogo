<?php
class Sankhalainfo_Manufacturerlogo_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {		
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function optionsAction()
	{
		$intAttributeId = $this->getRequest()->getParam('attribute_id');
		$objEavAttribute = Mage::getModel('eav/entity_attribute')->load($intAttributeId);
		$attributes = Mage::getResourceModel('eav/entity_attribute_collection')
			->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
			->addFieldToFilter('attribute_code', $objEavAttribute->getAttributeCode()) // This can be changed to any attribute code
			->load(false);
		 
		$attribute = $attributes->getFirstItem()->setEntity(Mage::getModel('catalog/product')->getResource());		
		$arrOptionValues = $attribute->getSource()->getAllOptions(false);
		$strAttributeOptionValues = '';
		$arrAttributeOptionValues = array();
		foreach($arrOptionValues as $arrSpecValue)
		{
			$arrAttributeOptionValues[] = trim($arrSpecValue['value']).'::'.trim($arrSpecValue['label']);
		}
		$strAttributeOptionValues = implode('#',$arrAttributeOptionValues);
		echo $strAttributeOptionValues;
	}
}