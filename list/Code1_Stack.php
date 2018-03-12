<?php

/**
 * 大小固定的栈
 */
class Stack
{
    private $length;
    private $i;

    private $array;

    public function __construct($length)
    {
        $this->array = array();
        $this->i = 0;
        $this->length = $length;
    }

    public function peek()
    {
        if($this->isEmpty())
            return null;

        return $this->array[$this->i-1];
    }

    public function pop()
    {
        if($this->isEmpty())
            return null;

        return $this->array[--$this->i];
    }

    public function push($data)
    {
        if($this->i == $this->length)
            return false;

        $this->array[$this->i++] = $data;
    }

    public function isEmpty()
    {
        return $this->i ==  0;
    }

    public function display()
    {
        foreach ($this->array as $item)
        {
            echo $item , '<br/>';
        }
    }
}
/*

$stack = new Stack();
$stack->push(1);
$stack->push(2);
$stack->push(3);
$stack->push(4);
$stack->push(5);
$stack->push(6);
$stack->display();
echo $stack->pop(), '<br/>';

*/