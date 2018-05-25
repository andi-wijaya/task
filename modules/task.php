<?php

require_once __DIR__ . '/../util/helper.php';

class Task implements \JsonSerializable{

  private $title;
  private $description;
  private $createdon;

  private $__type = [
    'title'=>[ 'required'=>1, 'datatype'=>'string', 'min_length'=>5, 'max_length'=>100 ]
  ];

  function construct1($title){

    $this->title = $title;

  }

  function construct2($title, $description){
    $this->title = $title;
    $this->description = $description;
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
      switch($name){
        case 'title': $this->$name = attr_get($name, [ $name=>$value ], [ 'datatype'=>'' ]); break;
        case 'description': $this->$name = attr_get($name, [ $name=>$value ], [ 'datatype'=>'' ]); break;
      }
      $this->$name = $value;
    }
  }

  /**
   * @return array|mixed
   */
  public function jsonSerialize(){
    $json = get_object_vars($this);
    unset($json['__type']);
    return $json;
  }

  /*
   * Static
   */
  public static function fromJSON($jsonString){

    $json = json_decode($jsonString, true);
    if(!is_array($json)) return null;

    $title = attr_get('title', $json);
    $description = attr_get('description', $json);

    $task = new Task;
    $task->title = $title;
    $task->description = $description;

    return $task;

  }

}

?>