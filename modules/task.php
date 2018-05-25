<?php

require_once __DIR__ . '/../util/helper.php';

class Task implements \JsonSerializable{

  private $__id;
  private static $__type = [
    'title'=>[ 'required'=>1, 'datatype'=>'string', 'min_length'=>5, 'max_length'=>100 ]
  ];

  private $title;
  private $description;
  private $createdon;

  /**
   * Any constructor
   */
  function construct(){

  }

  /**
   * Save to DB
   */
  public function save(){



  }

  /**
   * Task constructor. multiple arguments
   */
  public function __construct(){
    $args = func_get_args();
    $num_of_args = func_num_args();
    if (method_exists($this, $f = 'construct' . $num_of_args))
      call_user_func_array(array($this, $f), $args);
    else if (method_exists($this, $f = 'construct'))
      call_user_func_array(array($this, $f), $args);
  }

  public function __toString(){
    return '[' . __CLASS__ . ']';
  }

  public function __get($name){
    if(method_exists($this, $name)){
      $this->$name();
    }
    elseif(property_exists($this, $name) && strpos($name, '__') === false){
      return $this->$name;
    }
  }

  public function __set($name, $value){
    if(method_exists($this, $name)){
      $this->$name($value);
    }
    elseif(property_exists($this, $name)){
      $this->$name = attr_get($name, [ $name=>$value ], isset($this->__type[$name]) ? $this->__type[$name] : []);
    }
  }

  /**
   * @return array|mixed
   */
  public function jsonSerialize(){
    $json = get_object_vars($this);
    foreach($json as $key=>$value)
      if(strpos($key, '__') !== false) unset($json[$key]);
    return $json;
  }

  /*
   * Static
   */
  public static function fromJSON($jsonString){

    $json = json_decode($jsonString, true);
    if(!is_array($json)) return null;

    $obj = obj_create_by_type($json, Task::$__type);

    $class = __CLASS__;
    $task = new $class;
    foreach($obj as $key=>$value)
      $task->$key = $value;

    return $task;

  }

}

?>