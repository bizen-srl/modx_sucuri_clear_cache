<?php
/**
 * @name SucuriClearCache
 * @author Manuel Barbiero
 * @description Plugin to clear the sucuri cache on 'OnBeforeCacheUpdate' and cache for a single file 'OnFileManagerFileUpdate' event.
 * @PluginEvents OnBeforeCacheUpdate,OnFileManagerFileUpdate
 */

// Your core_path will change depending on whether your code is running on your development environment
// or on a production environment (deployed via a Transport Package).  Make sure you follow the pattern
// outlined here. See https://github.com/craftsmancoding/repoman/wiki/Conventions for more info

$core_path = $modx->getOption('sucuri.core_path', null, MODX_CORE_PATH.'components/sucuri/');
include_once $core_path .'vendor/autoload.php';

 // API keys
 $apiKey = $modx->getOption('sucuri.api_key');
 $apiSecret = $modx->getOption('sucuri.api_secret');

 // check if API keys are set
 if (empty($apiKey) && empty($apiSecret)) return;

 switch ($modx->event->name) {

		case 'OnBeforeCacheUpdate':

		//getting all available contexts
		$contexts = $modx->getCollection('modContext', array('key:NOT IN' => array('mgr')));

		//looping through all contexts
		foreach ($contexts as $context) { 
			$contextObj = $modx->getContext($context->key);

			if (!empty($contextObj->getOption('sucuri.api_key')) && !empty($contextObj->getOption('sucuri.api_secret'))) {
					// Contexts API keys
					$apiKey = $contextObj->getOption('sucuri.api_key');
					$apiSecret = $contextObj->getOption('sucuri.api_secret');
			}

			// Sending get request to Sucuri API with params to clear firewall cache
			$api = 'https://waf.sucuri.net/api?k='.$apiKey.'&s='.$apiSecret.'&a=clearcache';
			$response = \Httpful\Request::get($api)->send();

			if ($response->body) $modx->log(modx::LOG_LEVEL_INFO, 'Sucuri: ' . $response->body);

		}
        
	break;
	
		case 'OnFileManagerFileUpdate': 

			//getting all available contexts
			$contexts = $modx->getCollection('modContext', array('key:NOT IN' => array('mgr')));

			//looping through all contexts
			foreach ($contexts as $context) { 
				$contextObj = $modx->getContext($context->key);

				if (!empty($contextObj->getOption('sucuri.api_key')) && !empty($contextObj->getOption('sucuri.api_secret'))) {
						// Contexts API keys
						$apiKey = $contextObj->getOption('sucuri.api_key');
						$apiSecret = $contextObj->getOption('sucuri.api_secret');
				}

				// The path of the updated file
				$filePath = str_replace(MODX_BASE_PATH, '/', $modx->event->params['path']);

				/// Sending get request to Sucuri API with params to clear firewall cache
				$api = 'https://waf.sucuri.net/api?k='.$apiKey.'&s='.$apiSecret.'&a=clearcache&file='.$filePath;
				$response = \Httpful\Request::get($api)->send();

				if ($response->body) $modx->log(modx::LOG_LEVEL_INFO, 'Sucuri: ' . $response->body);
			}
		
			break;
		

}