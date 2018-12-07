<?php
/*-----------------------------------------------------------------
 * Lexicon keys for System Settings follows this format:
 * Name: setting_ + $key
 * Description: setting_ + $key + _desc
 -----------------------------------------------------------------*/
return array(

    array(
        'key'  		=>     'sucuri.api_key',
		'value'		=>     'a',
		'xtype'		=>     'textfield',
		'namespace' => 'sucuri',
		'area' 		=> 'sucuri:default'
    ),
    array(
        'key'  		=>     'sucuri.api_secret',
		'value'		=>     'a',
		'xtype'		=>     'textfield',
		'namespace' => 'sucuri',
		'area' 		=> 'sucuri:default'
    ),
);
/*EOF*/