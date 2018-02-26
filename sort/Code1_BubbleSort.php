<?php
/**
 * Created by PhpStorm.
 * User: zetao
 * Date: 2018/2/26
 * Time: 21:46
 */

function BubbleSort($array){
    if(empty($array))
        return false;

    $length = count($array);
    for($i=$length-2; $i>=0; $i--){
        for($j=0; $j<=$i; $j++){
            if($array[$j] > $array[$j+1]){
                swap($array, $j, $j+1);
            }
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
var_dump(BubbleSort([3,2,1]));