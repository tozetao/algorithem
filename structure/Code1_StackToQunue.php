<?php

include 'Code1_Stack.php';

/*
 * 栈转队列
 *     使用俩个栈进行实现。
 */
class StackToQunue
{
    private $dataStack;
    private $helpStack;

    public function __construct()
    {
        $this->dataStack = new Stack(15);
        $this->helpStack = new Stack(15);
    }

    public function peek()
    {
        $this->changeout();
        $this->helpStack->peek();
    }

    public function insert($data)
    {
        $this->changeout();
        $this->dataStack->push($data);
    }

    public function remove()
    {
        $this->changeout();
        return $this->helpStack->pop();
    }

    private function changeout()
    {
        if($this->helpStack->isEmpty())
        {
            while(!$this->dataStack->isEmpty())
            {
                $this->helpStack->push($this->dataStack->pop());
            }
        }
    }
}

echo '<pre/>';

$obj = new StackToQunue();
$obj->insert(1);
$obj->insert(2);
$obj->insert(3);
$obj->insert(4);
$obj->insert(5);

var_dump($obj->remove());
var_dump($obj->remove());
var_dump($obj->remove());

$obj->insert(15);
$obj->insert(20);

var_dump($obj->remove());
var_dump($obj->remove());
var_dump($obj->remove());
var_dump($obj->remove());
