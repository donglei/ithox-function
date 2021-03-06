<?php

if(!function_exists('ee'))
{
	function ee() {
                header("Content-type: text/html; charset=utf-8");
		echo '<pre>';
		array_map(function($msg) {
			print_r($msg);
		}, func_get_args());
		echo '</pre>';
		die;
	}
}

if(!function_exists('pe'))
{
	function pe() {
		echo '<pre>';
		array_map(function($msg) {
			print_r($msg);
		}, func_get_args());
		echo '</pre>';
	}
}

if(!function_exists('he'))
{
	function he() {
		echo "<!--\n";
		array_map(function($msg) {
			print_r($msg);
		}, func_get_args());
		echo "\n-->";
	}
}
if(!function_exists('get_methods'))
{
	function get_methods($obj) {
		return get_class_methods($obj);
	}
}

if(!function_exists('is_phone'))
{
	function is_phone($phone_number)
	{
		$pattern = '/^1[3|4|5|8][0-9]\d{8}$/';
		if(preg_match($pattern, $phone_number, $match))
		{
			return true;
		}

		return false;
	}
}

if(!function_exists('getdottime'))
{
    function getdottime($date)
    {
        return date('Y.m.d', strtotime($date));
    }
}

function array2xml($data, $root = '<root/>') 
{
    $xml = new SimpleXMLElement($root );
    array_walk_recursive($data, function($value, $key) use($xml){
        
        $node = dom_import_simplexml($xml);
        $element  =  $node->appendChild(new  DOMElement ( $key ));
        $no = $element->ownerDocument; 
        $element->appendChild($no->createCDATASection($value));  
    });
    return $xml->asXML();
    
}
