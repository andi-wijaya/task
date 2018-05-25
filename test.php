<?php

include 'modules/task.php';

header('Content-Type: text/plain');

$task1 = Task::fromJSON(json_encode([ 'title'=>'AB', 'description'=>'Description' ]));

$task1->titls = 'Helloss';
echo json_encode($task1);
echo $task1;


?>