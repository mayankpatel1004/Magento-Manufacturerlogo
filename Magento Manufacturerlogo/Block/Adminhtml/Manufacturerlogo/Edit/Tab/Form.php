<?php
class Sankhalainfo_Manufacturerlogo_Block_Adminhtml_Manufacturerlogo_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('manufacturerlogo_form', array('legend'=>Mage::helper('manufacturerlogo')->__('Attribute Logo information')));
   
  
		$attributes = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getAttributeCollection();
		$attributes->addStoreLabel(Mage::app()->getStore()->getId());
		$arrManufacrurers = array();
		foreach ($attributes as $attr)
		{
			if($attr->getAttributeCodesByFrontendType('multiselect') || $attr->getAttributeCodesByFrontendType('select'))
			{
				if($attr->getStoreLabel() != "")
				{
					$arrManufacrurers[] = array('value' => $attr->getId(),'label' => $attr->getStoreLabel());
				}
			}	
		}
	  
		$fieldset->addField('attribute_id', 'select', array(
		  'label'     => Mage::helper('manufacturerlogo')->__('Attribute'),
		  'name'      => 'attribute_id',
		  'values'    => $arrManufacrurers,
	  ));
	  $fieldset->addField('option_id', 'select', array(
		  'label'     => Mage::helper('manufacturerlogo')->__('Option'),
		  'name'      => 'option_id'
	  ));
	  
      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('manufacturerlogo')->__('Logo'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
	 /*$fieldset->addField('banner', 'file', array(
          'label'     => Mage::helper('manufacturerlogo')->__('Banner'),
          'required'  => false,
          'name'      => 'banner',
	  ));
*/
      if ( Mage::getSingleton('adminhtml/session')->getManufacturerlogoData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getManufacturerlogoData());
          Mage::getSingleton('adminhtml/session')->setManufacturerlogoData(null);
      } elseif ( Mage::registry('manufacturerlogo_data') ) {
          $form->setValues(Mage::registry('manufacturerlogo_data')->getData());
      }
      return parent::_prepareForm();
  }
}