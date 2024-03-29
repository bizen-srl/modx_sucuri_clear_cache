<?php
/*-----------------------------------------------------------------
 * Lexicon keys for System Settings follows this format:
 * Name: setting_ + $key
 * Description: setting_ + $key + _desc
 -----------------------------------------------------------------*/
return array(

    array(
        'key'  		=>     'sucuri.api_key',
		'value'		=>     '',
		'xtype'		=>     'textfield',
		'namespace' => 'sucuri',
		'area' 		=> 'sucuri:default'
    ),
    array(
        'key'  		=>     'sucuri.api_secret',
		'value'		=>     '',
		'xtype'		=>     'textfield',
		'namespace' => 'sucuri',
		'area' 		=> 'sucuri:default'
    ),
);
/*EOF*/