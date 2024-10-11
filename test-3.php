<?php

// Даны веса посылок $boxes и вес, который может увезти курьер $weight.
// Курьер должен возить по 2 посылки, которые вместе по весу будут строго равны $weight.
// Необходимо найти максимальное количество рейсов, которые курьер сможет сделать с учетом условий.

// первые входные данные
$boxes = [1, 2, 1, 5, 1, 3, 5, 2, 5, 5];
$weight = 6;

// to be 3
test($boxes, $weight, 3);

// вторые входные данные
$boxes = [2, 4, 3, 6, 1];
$weight = 5;

// to be 2
test($boxes, $weight, 2);

$boxes = [2,2];
$weight = 4;

// to be 1
test($boxes, $weight, 1);

$boxes = [2,2,1,3];
$weight = 4;

// to be 2
test($boxes, $weight, 2);


$boxes = [];
$weight = 5;

// to be 0
test($boxes, $weight, 0);


$boxes = [9, 9, 9, 9, 9];
$weight = 1;

// to be 0
test($boxes, $weight, 0);


$boxes = [1];
$weight = 1;

test($boxes, $weight, 1);
test($boxes, $weight, 0);


function test (array $boxes, int $weight, int $resultMustBe)
{
    $result = getResult($boxes, $weight);
    $isCorrect = $result === $resultMustBe;

    if ($isCorrect) {
        echo "Correct result {$result}", PHP_EOL;
    } else {
        echo "Incorrect result {$result}, must be {$resultMustBe}", PHP_EOL;
    }
}


function getResult(array $boxes, int $weight): int
{
    $count = 0;

    $cursor = 0;
    $boxWeight = array_shift($boxes);

    while(count($boxes)) {
        $otherBoxWeight = $boxes[$cursor] ?? null;

        if ($otherBoxWeight === null) {
            $cursor = 0;
            $boxWeight = array_shift($boxes);
        }

        $sum = $boxWeight + $otherBoxWeight;
        if ($sum === $weight) {
            $count++;
            unset($boxes[$cursor]);

            // reset indexes
            $boxes = array_values($boxes);

            $cursor = 0;
            $boxWeight = array_shift($boxes);
        } else {
            $cursor++;
        }
    }

    return $count;
}
