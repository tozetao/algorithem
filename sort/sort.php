<?php
echo "<pre/>";


function randNums()
{
	$array = array();
	for($j=0; $j<10; $j++)
	{
		$array[] = mt_rand(1, 100);
	}
	return $array;
}


/*
冒泡排序
	每次需要进行n-1次冒泡，时间复杂度为O(n^2)，
	无论输入数据是在最好情况或者是最快情况，冒泡排序的效率都是一样的。
*/

function bubbleSort($array)
{
	$length = count($array);
	$temp = null;

	for($i=0; $i<$length-1; $i++)
	{
		for($j=0; $j<$length-$i-1; $j++)
		{
			if($array[$j] > $array[$j+1])
			{
				$temp = $array[$j+1];
				$array[$j+1] = $array[$j];
				$array[$j] = $temp;
			}
		}
	}

	return $array;
}

// print_r(bubbleSort([10, 8, 15, 3, 4, 5, 25, 22]));

/*
插入排序
	插入排序是使用无序的数据项与有序的数据项比较的一个算法。

	假设有A B C D 4个数据项，假设A是左边有序的数据项，那么会有3次比较，
	分别是：A、A B、A B C，所以插入排序需要进行n-1次插入排序的过程。
	
	在输入最好的情况下，例如数列是有序的，插入排序只需要进行n-1次比较，
	在输入最快的情况下，效率与冒泡排序相同，

	在一般情况下，使用一个数字与有序部分数据项比较的次数是1/2，所以效率大体会比
	冒泡排序快一倍左右。
*/


function insertSort($array)
{
	$length = count($array);
	for($i=1; $i<$length; $i++)
	{
		//待比较的数字
		$temp = $array[$i];
		$j = $i-1;

		// 6 3 5 9 
		while($j>=0 && $array[$j]>$temp)
		{
			$array[$j+1] = $array[$j];
			$j--;
		}
		$array[$j+1] = $temp;
	}
	return $array;
}

// var_dump(insertSort([10, 9, 8, 8, 7, 12, 6, 5, 4, 3, 2, 1]));


/*
快速排序
	0 1 2 3 4 5
	--------------------
2	0 1
	3 4 5
	
0	0 -1
	1 1
	return
*/

function out_array($array)
{
	foreach ($array as $value) {
		echo $value . '&nbsp;';
	}
	echo '<br/>';
}

function quickSort(&$array, $left, $right)
{
	if($left >= $right)
		return;

	$temp = null;	
	
	$i = $left;
	$j = $right;

	while ($i < $j) 
	{
		while($i<$j && $array[$j] >= $array[$left])
			$j--;

		while($i<$j && $array[$i] <= $array[$left])
			$i++;

		if($i<$j)
		{
			$temp = $array[$j];
			$array[$j] = $array[$i];
			$array[$i] = $temp;
		}
	}
	$temp = $array[$left];
	$array[$left] = $array[$i];
	$array[$i] = $temp;

	quickSort($array, $left, $i-1);
	quickSort($array, $i+1, $right);
	return $array;
}
/*
// $array = [27, 99, 67, 49, 30, 93, 56, 45, 63, 54];
// print_r(quickSort($array, 0, count($array)-1));

for($i=0; $i<10; $i++)
{
	$array = array();
	for($j=0; $j<10; $j++)
	{
		$array[] = mt_rand(1, 100);
	}
	print_r(quickSort($array, 0, count($array)-1));
}
*/

/*
9 8 3 7 6 5


(0+2)/2=1
(0+1)/2=0
(0+0)/2=0

$p：中间数
*/
function mergeSort(&$array, $left, $right)
{
	if($left>=$right)
		return;

	$middle = floor(($left + $right)/2);

	mergeSort($array, $left, $middle);
	mergeSort($array, $middle+1, $right);

	merge($array, $left, $middle, $right);
}

function fill($array, $start, $end)
{
	$newArray = array();
	while ($start <= $end) 
	{
		$newArray[] = $array[$start];
		$start++;
	}
	return $newArray;
}

/*
	1 3 4
	5 8

	q  m
	----
	0  4	1
	1  4	1 3
	2  4	1 3 4
	3  4	
	4  4
*/
function merge(&$array, $q, $p, $m)
{
	$leftArray = fill($array, $q, $p);
	$leftArray[] = PHP_INT_MAX;

	$rightArray = fill($array, $p+1, $m);
	$rightArray[] = PHP_INT_MAX;

	$i = 0;
	$j = 0;

	while ($q<=$m)
	{
		if($leftArray[$i] > $rightArray[$j])
		{
			$array[$q] = $rightArray[$j];
			$j++;
		}
		else
		{
			$array[$q] = $leftArray[$i];
			$i++;
		}
		$q++;
	}
}

// $array = [12, 19, 23, 3, 5, 7];
// merge($array, 0, 2, 5);
// print_r($array);

for($i=0; $i<10; $i++)
{
	$array = randNums();
	print_r($array);
	mergeSort($array, 0, count($array)-1);
	print_r($array);	
}
