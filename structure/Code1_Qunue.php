<?php

/*
 * 加数操作
 *     定义end指针指向要添加数的位置，从0位置开始加数，如果到达数组尾部end重置为0，以此循环
 *
 * 减数操作
 *     定义start指针指向要减树的位置，从0位置开始减数，如果到达数组尾部start重置为0，以此循环
 *
 * 加数与减数操作通过数组size来进行约束，避免加数和减数操作错误；
 * 即加数时，如果数组满了停止操作；减数时如果数组为空停止操作，将start与end的关系进行解耦
 */
class Qunue
{
    private $array;

    private $length;

    //队列中数据项的个数
    private $size;

    //pop指针
    private $start;

    //insert指针
    private $end;

    public function __construct($length)
    {
        $this->length = $length;
        $this->size = 0;
        $this->start = 0;
        $this->end = 0;
    }

    public function insert($data)
    {
        if($this->size == $this->length)
            return false;

        $this->array[$this->end] = $data;
        $this->size++;

        $this->end = ($this->end == $this->length-1) ? 0 : $this->end+1;
    }

    public function peek()
    {
        if($this->size == 0)
            return null;

        return $this->array[$this->start];
    }

    public function pop()
    {
        if($this->size == 0)
            return null;

        $temp = $this->array[$this->start];
        $this->size--;

        $this->start = ($this->start == $this->length-1) ? 0 : $this->start+1;
        return $temp;
    }

    public function display()
    {
        foreach ($this->array as $item)
        {
            echo $item, '<br/>';
        }
    }
}

/*
echo '<pre/>';
$qunue = new Qunue(3);

$qunue->insert(1);
$qunue->insert(2);
$qunue->insert(3);

$qunue->display();


var_dump($qunue->insert(10));

var_dump($qunue->pop());
var_dump($qunue->pop());

$qunue->insert(25);

var_dump($qunue->peek());
var_dump($qunue->pop());


var_dump($qunue->pop());
var_dump($qunue->pop());
var_dump($qunue->pop());
*/