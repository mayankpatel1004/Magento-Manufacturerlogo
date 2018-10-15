<?php
class Sankhalainfo_Manufacturerlogo_Block_Adminhtml_Manufacturerlogo extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_manufacturerlogo';
    $this->_blockGroup = 'manufacturerlogo';
    $this->_headerText = Mage::helper('manufacturerlogo')->__('Attribute Logo Manager');
    $this->_addButtonLabel = Mage::helper('manufacturerlogo')->__('Add Attribute Logo');
    parent::__construct();
  }
}