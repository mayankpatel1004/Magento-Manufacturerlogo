<?php
class Sankhalainfo_Manufacturerlogo_Block_Manufacturerlogo extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getManufacturerlogo()     
     { 
        if (!$this->hasData('manufacturerlogo')) {
            $this->setData('manufacturerlogo', Mage::registry('manufacturerlogo'));
        }
        return $this->getData('manufacturerlogo');
        
    }
}