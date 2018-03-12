<?php

include "./Code1_Qunue.php";

/*
 * 队列转栈
 *     1. 一个Data、一个help栈，Data栈存储数据，help栈用于辅助
 *     2. 将Data栈中数据压入到help栈中，直到Data栈只剩下一个数据项时停止压入，所弹出的数据项就是后进先出的数据项
 *     3. 将help栈与Data栈的引用进行交换，重复第二个步骤，直到Data栈为空
 */
class QunueToStack
{
    private $dataQunue;
    private $helpQunue;

    public function __construct()
    {
        $this->dataQunue = new Qunue(10);
        $this->helpQunue = new Qunue(10);
    }

    public function peek()
    {
        while($this->dataQunue->size() > 1)
        {
            $this->helpQunue->insert($this->dataQunue->pop());
        }
        $temp = $this->dataQunue->pop();
        $this->helpQunue->insert($temp);
        $this->swap();
        return $temp;
    }

    public function push($data)
    {
        return $this->dataQunue->insert($data);
    }

    public function pop()
    {
        while($this->dataQunue->size() > 1)
        {
            $this->helpQunue->insert($this->dataQunue->pop());
        }

        $temp = $this->dataQunue->pop();
        $this->swap();
        return $temp;
    }

    public function swap()
    {
        $temp = $this->dataQunue;
        $this->dataQunue = $this->helpQunue;
        $this->helpQunue = $temp;
    }
}

$obj = new QunueToStack();
$obj->push(1);
$obj->push(2);
$obj->push(3);
$obj->push(4);

echo '<pre/>';
var_dump($obj->pop());

$obj->push(10);

var_dump($obj->pop());
var_dump($obj->pop());
var_dump($obj->pop());

var_dump($obj->peek());
var_dump($obj->pop());