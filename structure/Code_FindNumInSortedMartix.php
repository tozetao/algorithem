<?php

/*
 * 假定一个矩阵，从左到右的数字时有序的，从上到下的数字时有序的，
 * 要求你寻找一个数字是否在矩阵中，时间复杂度是O(N+M)
 */
class FindNumInSortedMartix
{
    private $martix;
    private $x;
    private $y;

    public function __construct()
    {
        $this->martix = [
            [1, 3, 5, 7],
            [2, 5, 8, 10],
            [3, 8, 15, 20],
            [4, 9, 17, 25],
        ];
        $this->x = 0;
        $this->y = count(current($this->martix)) - 1;
    }

    public function find($number)
    {
        $numRow = count($this->martix)-1;
        while($this->x <= $numRow && $this->y >= 0)
        {
            $tmp = $this->martix[$this->x][$this->y];
            if($tmp > $number)
                $this->y--;
            else if($tmp < $number)
                $this->x++;
            else
                return true;
        }
        return false;
    }
}

$obj = new FindNumInSortedMartix();
var_dump($obj->find(6));