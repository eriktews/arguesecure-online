<?php 
namespace App\Helpers;

class TreeNodeHelpers
{
    static public function get($object, $information)
    {
        if ( is_object($object) ) {
        	if (class_basename($object) == "Defence" && $object->is_transfer)
        		return config('nodes.Transfer.'.$information);
           	return config('nodes.'.class_basename(get_class($object).'.'.$information));
        }
        return config('nodes.'.$object.'.'.$information);
    }

}
 
