<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('manufacturerlogo')};
CREATE TABLE {$this->getTable('manufacturerlogo')} (
  `manufacturerlogo_id` int(11) unsigned NOT NULL auto_increment,
  `filename` varchar(255) NOT NULL default '',
  `option_id` smallint(6) NOT NULL default '0',
  `tag_line` varchar(2048) NOT NULL default '',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`manufacturerlogo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 