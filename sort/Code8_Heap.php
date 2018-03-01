<?php

/**
 * 大根堆
 */
class Heap
{
    private $array;
    private $length;

    public function __construct($array)
    {
        $this->array = $array;
        $this->length = count($array);
    }

    //节点上下比较的过程
    public function heapInsert($index)
    {
        while($index > 0){
            $parent = floor($index-1)/2;

            if($this->array[$parent] > $this->array[$index])
            {
                $this->swap($parent, $index);
                $index = $parent;
            }else
            {
                break;
            }
        }
    }

    //节点向下比较的过程
    public function heapify($index)
    {
        $left = $index * 2 + 1;
        while($left < $this->length)
        {
            $maxIndex = $index;

            $right = $index * 2 + 2;
            if(isset($this->array[$right]) && $this->array[$maxIndex] < $this->array[$right])
            {
                $maxIndex = $right;
            }


            if($this->array[$maxIndex] < $this->array[$left])
            {
                $maxIndex = $left;
            }

            //不需要交换子节点
            if($index == $maxIndex)
            {
                break;
            }

            $this->swap($index, $maxIndex);
            $index = $maxIndex;
            $left = $index * 2 + 1;
        }
    }

    private function swap($left, $right)
    {
        $temp = $this->array[$left];
        $this->array[$left] = $this->array[$right];
        $this->array[$right] = $temp;
    }
}