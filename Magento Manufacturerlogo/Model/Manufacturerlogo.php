<?php

class Sankhalainfo_Manufacturerlogo_Model_Manufacturerlogo extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('manufacturerlogo/manufacturerlogo');
    }
	
	public function fnGetManufacurers()
	{
			$product = Mage::getModel('catalog/product');
			$attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'manufacturer');
			$attribute = $attributes->getFirstItem()->setEntity($product->getResource());
			$manufacturers = $attribute->getSource()->getAllOptions(false);
			return $manufacturers;
	}
	
	public function fnGetManufacturerName($intOptionId)
	{
		$arrManufacturers = $this->fnGetManufacurers();
		$strName = '';
		foreach($arrManufacturers as $arrOption)
		{
			if($arrOption['value'] == $intOptionId)
			{
				$strName = $arrOption['label'];
				break;
			}
		}
		return $strName;
	}
	
	public function fnGetTagLine($intOptionId)
	{
		$strTagLine = '';
		$objManufacturerLogo = $this->getCollection()->addFieldToFilter('option_id',$intOptionId);
		if($objManufacturerLogo->count())
		{
			foreach($objManufacturerLogo as $objLogo)
			{
				$strTagLine = $objLogo->getTagLine();
				break;
			}
		}
		return $strTagLine;
	}
	
	public function fnGetManufacturerGridValues()
	{
		$arrGridManufacturers = array();
		
		$product = Mage::getModel('catalog/product');
		
		$attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'manufacturer');
		
		$attribute = $attributes->getFirstItem()->setEntity($product->getResource());
		$manufacturers = $attribute->getSource()->getAllOptions(false);
		if(count($manufacturers))
		{
			foreach($manufacturers as $key => $arrValue)
			{
				$arrGridManufacturers[$arrValue["value"]] = $arrValue["label"];
			}
		}
		return $arrGridManufacturers;
	}
	
	
	
	
	public function fnGetAttributesGridValues()
	{
		$arrGridManufacturers = array();
		
		$attributes = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getAttributeCollection();
		$attributes->addStoreLabel(Mage::app()->getStore()->getId());
		$arrManufacrurers = array();
		foreach ($attributes as $attr)
		{
			if($attr->getAttributeCodesByFrontendType('multiselect') || $attr->getAttributeCodesByFrontendType('select'))
			{
				if($attr->getStoreLabel() != "")
				{
					$arrGridManufacturers[$attr->getId()] = $attr->getStoreLabel();
				}	
			}	
		}
		
		
		/*if(count($manufacturers))
		{
			foreach($manufacturers as $key => $arrValue)
			{
				$arrGridManufacturers[$arrValue["value"]] = $arrValue["label"];
			}
		}*/
		return $arrGridManufacturers;
	}
	
	
	
	
	
	
	
	
	
	public function fnGetManufacturerLogos()
	{
		$collection = Mage::getModel('manufacturerlogo/manufacturerlogo')->getCollection();
		return $collection;
	}
	public function fnGetBrandLogoUrl($intOptionId)
	{
		$objManufacturerLogo = $this->getCollection()->addFieldToFilter('option_id',$intOptionId);
		if($objManufacturerLogo->count())
		{
			foreach($objManufacturerLogo as $objSpecBrandLogo)
			{	
				$strMediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
				return $strMediaUrl.'attributelogo/'.$objSpecBrandLogo->getFilename();
			}
		}
		return '';
	}
}