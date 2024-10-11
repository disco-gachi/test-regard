<?php

// Напишите функцию, которая развернёт список.
// Последний элемент должен стать первым, а первый - последним. 
// $c→next должен содержать $b и так далее...

class test {
	public function __construct(public string $mark) {}
	public $next;
}

$a = new test('a');
$b = new test('b');
$c = new test('c');
$a->next = $b;
$b->next = $c;
$c->next = null;


$ob1 = reverse($a);
var_dump($ob1);


function reverse(test $head) {
	$next = getNext($head);
	
	if (!$next) {
		return $head;
	}
	
	$objMap = [$head];
	while ($next) {
		array_unshift($objMap, $next);
		$next = getNext($next);
	}
	
	foreach ($objMap as $key => $obj) {
		$nextObj = $objMap[$key + 1];
		$obj->next = $nextObj;
	}
	
	return $objMap[0];
}

function getNext(test $obj) {
	if ($obj->next && $obj->next instanceof test) {
		return $obj->next;
	}
	return null;
}
