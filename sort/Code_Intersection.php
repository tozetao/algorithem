<?php

//在俩个有序的数组中寻找交集的部分
function Intersection($array1, $array2){
    $leftLength = count($array1);
    $rightLength = count($array2);

    $leftPoint = 0;
    $rightPoint = 0;

    $same = array();

    while($leftPoint < $leftLength && $rightPoint < $rightLength){
        if($array1[$leftPoint] < $array2[$rightPoint]){
            $leftPoint++;
        }else if($array1[$leftPoint] > $array2[$rightPoint]){
            $rightPoint++;
        }else{
            $same[] = $array1[$leftPoint];

            $leftPoint++;
            $rightPoint++;
        }
    }

    return $same;
}

$array1 = [1, 3, 5, 7, 9, 10];
$array2 = [2, 3, 6, 8, 9];

echo '<pre/>';
print_r(Intersection($array1, $array2));