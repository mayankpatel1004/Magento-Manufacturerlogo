<?php

class Sankhalainfo_Manufacturerlogo_Block_Adminhtml_Manufacturerlogo_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('manufacturerlogoGrid');
      $this->setDefaultSort('manufacturerlogo_id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('manufacturerlogo/manufacturerlogo')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('manufacturerlogo_id', array(
          'header'    => Mage::helper('manufacturerlogo')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'manufacturerlogo_id',
      ));
	  
	  $arrAttributes = Mage::getModel('manufacturerlogo/manufacturerlogo')->fnGetAttributesGridValues();
	  $this->addColumn('attribute_id', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Attributes Options'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'attribute_id',
          'type'      => 'options',
          'options'   => $arrAttributes,
      ));
	  
	  $this->addColumn('tag_line', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Tag Line'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'tag_line',
      ));
	  
	   $this->addColumn('filename', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Logo'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'filename',
		  'renderer'  => 'manufacturerlogo/adminhtml_manufacturerlogo_grid_logo'
      ));

     /* $this->addColumn('title', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));*/

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('manufacturerlogo')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

	  




      /*$this->addColumn('option_id', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Option'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'option_id',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
	 /* $this->addColumn('option_id', array(
          'header'    => Mage::helper('manufacturerlogo')->__('Select Option'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('manufacturerlogo')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('manufacturerlogo')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('manufacturerlogo')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('manufacturerlogo')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('manufacturerlogo_id');
        $this->getMassactionBlock()->setFormFieldName('manufacturerlogo');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('manufacturerlogo')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('manufacturerlogo')->__('Are you sure?')
        ));

       
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}