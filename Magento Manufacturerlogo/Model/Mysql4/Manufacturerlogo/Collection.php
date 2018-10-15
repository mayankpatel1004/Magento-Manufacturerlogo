<?php

class Sankhalainfo_Manufacturerlogo_Model_Mysql4_Manufacturerlogo_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('manufacturerlogo/manufacturerlogo');
    }
}