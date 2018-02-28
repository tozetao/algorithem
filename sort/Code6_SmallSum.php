<?php

/**
 * 最小数之和：在一个整数数组中，求每个数组项左边小于它的数据项之和
 *
 *  求每个数据项左边小于它的数据项之和，可以理解成求每个数据项右边大于它的数据项的次数 乘以 该数据项之和。
 *
 *  由于归并排序自底向上合并左右俩部分数据项的过程中，左右俩部分数据项都是有序的，
 *  所以在合并中对比左右俩部分数据项时，可以求出左边部分每个数据项在右边数据项中有多少个大于它的次数
 */

function SmallSum(&$array, $left, $right){
    //basecase
    if($right <= $left)
        return 0;

    $mid = floor(($left+$right)/2);

    $leftSum = SmallSum($array, $left, $mid);
    $rightSum = SmallSum($array, $mid+1, $right);

    return $leftSum + $rightSum + MergeSum($array, $left, $mid, $right);
}

//
function MergeSum(&$array, $left, $mid, $right){
    $tempArr = array();
    $sum = 0;
    $p1 = $left;
    $p2 = $mid+1;

    while($p1<=$mid && $p2<=$right){
        if($array[$p1] < $array[$p2]){
            $sum += ($right-$p2+1) * $array[$p1];
            $tempArr[] = $array[$p1++];
        }else{
            $tempArr[] = $array[$p2++];
        }
    }

    while($p1<=$mid){
        $tempArr[] = $array[$p1++];
    }
    while($p2<=$right){
        $tempArr[] = $array[$p2++];
    }

    for($i=0; $i<count($tempArr); $i++){
        $array[$left+$i] = $tempArr[$i];
    }

    return $sum;
}

echo '<pre/>';
$array = [3, 1, 2, 7, 5, 90];

echo SmallSum($array, 0, count($array)-1);
echo '<br/>';
print_r($array);