<?php

include 'modules/task.php';

header('Content-Type: text/plain');

$task1 = Task::fromJSON(json_encode([ 'title'=>'AB', 'description'=>'Description' ]));

echo json_encode($task1);




?>