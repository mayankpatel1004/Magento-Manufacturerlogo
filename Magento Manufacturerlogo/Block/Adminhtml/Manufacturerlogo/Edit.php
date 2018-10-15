<?php

class Sankhalainfo_Manufacturerlogo_Block_Adminhtml_Manufacturerlogo_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'manufacturerlogo';
        $this->_controller = 'adminhtml_manufacturerlogo';
        
        $this->_updateButton('save', 'label', Mage::helper('manufacturerlogo')->__('Save Attribute Logo'));
        $this->_updateButton('delete', 'label', Mage::helper('manufacturerlogo')->__('Delete Attribute Logo'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('manufacturerlogo_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'manufacturerlogo_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'manufacturerlogo_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
			Event.observe('attribute_id','change',function(){
				intAttributeId = this.value;
				strRequestUrl = '".$this->getUrl('manufacturerlogo/index/options')."';
				strRequestUrl += '?attribute_id='+intAttributeId;
				new Ajax.Request(strRequestUrl, {
				  onSuccess: function(response) {
					strResponse = response.responseText;
					arrResponse = strResponse.split('#');	
					$('option_id').options.length = 0;				
					if(arrResponse.length > 0)
					{
						for(intR=0;intR<arrResponse.length;intR++)
						{
							strResponseValue = arrResponse[intR];
							arrResponseValue = strResponseValue.split('::');
							intOptionId = arrResponseValue[0];							
							strOptionLabel = arrResponseValue[1];							
							var Dropoption = new Option(strOptionLabel,intOptionId);							
							$('option_id').add(Dropoption);
						}
					}
				  }
				});
			});
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('manufacturerlogo_data') && Mage::registry('manufacturerlogo_data')->getId() ) {
            return Mage::helper('manufacturerlogo')->__("Edit Attribute Logo '%s'", $this->htmlEscape(Mage::registry('manufacturerlogo_data')->getTitle()));
        } else {
            return Mage::helper('manufacturerlogo')->__('Add Attribute Logo');
        }
    }
}