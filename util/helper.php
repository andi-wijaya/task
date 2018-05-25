<?php

function attr_get($key, $obj, $options = null){

  $required = isset($options['required']) && $options['required'] > 0 ? true : false;
  $default_value = isset($options['default_value']) ? $options['default_value'] : null;

  $value = $default_value;
  if($required){
    if(!isset($obj[$key])) throw new Exception("Missing parameter: $key");
  }
  return $value;

}

function obj_create_by_type($obj, $type){

  $result_obj = [];
  foreach($type as $key=>$property){
    $result_obj[$key] = attr_get($key, $obj, $property);
  }
  return $result_obj;

}

?>