<?php 
namespace App\Helpers;

class TreeNodeHelpers
{
    static public function get($object, $information)
    {
        if ( is_object($object) )
            return config('nodes.'.class_basename(get_class($object).'.'.$information));
        return config('nodes.'.$object.'.'.$information);
    }

}
 
