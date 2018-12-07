<?php
/**
 * @name SucuriClearCache
 * @description Plugin to clear the sucuri cache on 'OnBeforeCacheUpdate' modx event.
 * @PluginEvents OnBeforeCacheUpdate
 */
/**/


// Your core_path will change depending on whether your code is running on your development environment
// or on a production environment (deployed via a Transport Package).  Make sure you follow the pattern
// outlined here. See https://github.com/craftsmancoding/repoman/wiki/Conventions for more info

$core_path = $modx->getOption('sucuri.core_path', null, MODX_CORE_PATH.'components/sucuri/');
include_once $core_path .'vendor/autoload.php';

switch ($modx->event->name) {

    case 'OnBeforeCacheUpdate':
        
        /* API keys*/

		$apiKey = $modx->getOption('sucuri.api_key');
		$apiSecret = $modx->getOption('sucuri.api_secret');

		//getting all available contexts
		$contexts = $modx->getCollection('modContext', array('key:NOT IN' => array('mgr')));

		//looping through all contexts
		foreach ($contexts as $context) { 
			if(empty($apiKey) && empty($apiSecret)){
				$apiKey = $context->getOption('sucuri.api_key');
				$apiSecret = $context->getOption('sucuri.api_secret');
			}

			// calling Sucuri API to clear firewall cache
			$api = curl_init('https://waf.sucuri.net/api?k='.$apiKey.'&s='.$apiSecret.'&a=clearcache');
			$result = curl_exec($api);

			if (curl_exec($api)) {
		        $modx->log(modx::LOG_LEVEL_INFO, 'Sucuri: cache for ' . $context->getOption('http_host') . ' [' . $context->key . '] successfully cleared. Success: ' . $result);
		    } else {
		        $modx->log(modx::LOG_LEVEL_ERROR, 'Sucuri: Something went wrong -> ' . curl_error($api));
		    }

		    curl_close($api);
		    ob_flush();

		}
        
        break;

}