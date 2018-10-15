<?php

class Sankhalainfo_Manufacturerlogo_Block_Adminhtml_Manufacturerlogo_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('manufacturerlogo_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('manufacturerlogo')->__('Attribute Logo Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('manufacturerlogo')->__('Attribute Logo Information'),
          'title'     => Mage::helper('manufacturerlogo')->__('Attribute Logo Information'),
          'content'   => $this->getLayout()->createBlock('manufacturerlogo/adminhtml_manufacturerlogo_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}