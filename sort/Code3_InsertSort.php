<?php

function InsertSort($array){
    $length = count($array);

    for($i = 1; $i<$length; $i++){
        for($j=$i; $j>0 && $array[$j] < $array[$j-1]; $j--){
                swap($array, $j, $j-1);
        }
    }

    return $array;
}

function swap(&$array, $l, $r){
    $temp = $array[$l];
    $array[$l] = $array[$r];
    $array[$r] = $temp;
}

echo '<pre/>';
var_dump(InsertSort([3, 7, 29, 192, 34, 54, 20, 28, 18]));
// 7 3 5 -> 3 7 5 ->