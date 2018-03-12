<?php

include "./Code1_Stack.php";

/*
 * 实现一个队列
 *     要求有pop()、push()、getMin()接口，并且时间复杂度为O(1)
 *
 * 俩个栈来实现，Data栈存储实际数据；Min栈存储栈的最小值；
 * Data栈每加入一个数据项，Min栈边存储当前Data栈的最小值，
 *
 * 具体做法是：
 *     Data栈加入的数据项与Min栈的栈顶元素比较，如果小于Min的栈顶元素，
 *     Min栈则添加Data栈加入的数据项，否则Min栈栈顶数据项重复添加
 *
 */
class GetMinStack
{
    private $dataStack;
    private $minStack;

    public function __construct()
    {
        $this->dataStack = new Stack(10);
        $this->minStack = new Stack(10);
    }

    public function getMin()
    {
        return $this->minStack->peek();
    }

    public function peek()
    {
        if($this->dataStack->isEmpty() && $this->minStack->isEmpty())
            return null;

        return $this->dataStack->peek();
    }

    public function pop()
    {
        if($this->dataStack->isEmpty() && $this->minStack->isEmpty())
            return null;

        $this->minStack->pop();
        return $this->dataStack->pop();
    }

    public function push($data)
    {
        $this->dataStack->push($data);
        if($this->minStack->isEmpty())
            $this->minStack->push($data);
        else if($data < $this->minStack->peek())
            $this->minStack->push($data);
        else
            $this->minStack->push($this->minStack->peek());
    }

    public function display()
    {
        $this->minStack->display();
    }
}

/*
echo '<pre/>';

$minStack = new GetMinStack();
$minStack->push(51);
$minStack->push(15);
$minStack->push(5);
$minStack->push(19);
$minStack->push(32);
$minStack->push(1);

$minStack->display();
var_dump($minStack->getMin());
*/
