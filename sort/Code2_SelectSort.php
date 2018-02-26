<?php

function SelectSort($array){
    $length = count($array);

    for($i = 0; $i < $length-1; $i++){
        $temp = $i;

        for($j=$i; $j < $length; $j++){
            if($array[$temp] > $array[$j]){
                $temp = $j;
            }
        }

        swap($array, $i, $temp);
    }

    return $array;
}

function swap(&$array, $l, $r){
    $temp = $array[$l];
    $array[$l] = $array[$r];
    $array[$r] = $temp;
}

echo '<pre/>';

var_dump(SelectSort([3, 7, 29, 192, 34, 54, 20, 28, 18]));