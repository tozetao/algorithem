<?php

function QuickSort(&$array, $left, $right){
    if($right < $left)
    {
        $part = HollandPartition($array, $left, $right);
        QuickSort($array, $left, $part[0]-1);
        QuickSort($array, $part[1]+1, $right);
    }
}

function partition($array, $left, $right){
    $midVal = $array[$right];
    $less = $left-1;

    while($left <= $right)
    {
        if($array[$left] <= $array[$midVal]){
            swap($array, ++$less, $left);
        }
        $left++;
    }
}

function HollandPartition(&$array, $left, $right)
{
    $less = $left-1;
    $greater = $right;

    $midVal = $array[$right];

    while($left < $greater)
    {
        if($array[$left] < $midVal){
            swap($array, ++$less, $left);
            $left++;
        }else if($array[$left] == $midVal){
            $left++;
        }else{
            swap($array, $left, --$greater);
        }
    }
    swap($array, $greater, $right);
    return [$less+1, $greater];
}

function swap(&$array, $left, $right){
    $temp = $array[$left];
    $array[$left] = $array[$right];
    $array[$right] = $temp;
}

$array = [0, 4, 5, 4, 3, 6, 4];
$r = HollandPartition($array, 0, count($array)-1);

echo '<pre/>';
print_r($r);
print_r($array);