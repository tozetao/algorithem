<?php

function MergeSort(&$array, $left, $right){
    if($right == $left)
        return;

    $mid = floor(($left+$right)/2);

    MergeSort($array, $left, $mid);
    MergeSort($array, $mid+1, $right);

    merge($array, $left, $mid, $right);
}

//合并俩个有序数组
function merge(&$array, $left, $mid, $right){
    $tempArray = array();

    $a = $left;
    $b = $mid+1;

    while($a <= $mid && $b<=$right){
        if($array[$a] < $array[$b]){
            $tempArray[] = $array[$a++];
        }else{
            $tempArray[] = $array[$b++];
        }
    }

    while($a<=$mid){
        $tempArray[] = $array[$a++];
    }
    while($b<=$right){
        $tempArray[] = $array[$b++];
    }

    for($i=0; $i<count($tempArray); $i++){
        $array[$left++] = $tempArray[$i];
    }
}

echo '<pre/>';
$array = [3, 1, 2, 7, 5, 90];

MergeSort($array, 0, count($array)-1);
var_dump($array);
