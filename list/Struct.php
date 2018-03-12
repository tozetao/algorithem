<?php

/**
* 栈：后进先出
*/
class ArrayStack
{
	private $array;
	private $top;

	public function __construct()
	{
		$this->array = array();
		$this->top = 0;
	}

	//入栈
	public function push($value)
	{
		$this->array[$this->top++] = $value;
	}

	//出栈
	public function remove()
	{
		if($this->isEmpty())
			return null;

		return $this->array[--$this->top];
	}

	public function isEmpty()
	{
		return ($this->top == 0);
	}
}

/*
$stack = new ArrayStack();
$stack->push(1);
$stack->push(2);
$stack->push(3);
$stack->push(4);
$stack->push(5);

while (!$stack->isEmpty()) {
	echo $stack->remove(), '<br/>';
}

echo '<br/>';
*/

/**
* 队列：先进先出
*/
class ArrayQunue
{
	private $top;
	private $end;
	private $array;

	public function __construct()
	{
		$this->top = 0;
		$this->end = 0;
		$this->array = array();
	}

	public function insert($value)
	{
		$this->array[$this->end++] = $value;
	}

	public function remove()
	{
		if($this->isEmpty())
			return null;

		return $this->array[$this->top++];
	}

	public function isEmpty()
	{
		return ($this->top == $this->end);
	}
}

/*
$qunue = new ArrayQunue();
$qunue->insert(1);
$qunue->insert(2);
$qunue->insert(3);
$qunue->insert(4);
$qunue->insert(5);

while (!$qunue->isEmpty()) {
	echo $qunue->remove(), '<br/>';
}
*/


/**
* 链表
*/
class Link{
	public $data;
	public $next;
	public $previous;
}

/*
双向链表
	在表头插入：建立节点的2个关联
	在表尾插入：建立节点的2个关联

	如果是在链表中间插入的话，需要建立3个节点的关系，也就是4个关联。

*/
class LinkList
{
	private $first;
	private $last;

	public function __construct()
	{
		$this->first = null;
	}

	public function insertFirst($data)
	{
		$newLink = new Link();
		$newLink->data = $data;		

		//新节点的next变量指向老节点
		$newLink->next = $this->first;

		if($this->isEmpty())
			$this->last = $newLink;
		else
			$this->first->previous = $newLink;

		//更新第一个节点引用
		$this->first = $newLink;
	}

	public function deleteFirst()
	{
		$tempLink = $this->first;
		$this->first = $this->first->next;
		return $tempLink->data;
	}

	public function insertLast($data)
	{
		$newLink = new Link();
		$newLink->data = $data;

		$newLink->previous = $this->last;

		if($this->isEmpty())
			$this->first = $newLink;
		else
			$this->last->next = $newLink;

		$this->last = $newLink;
	}

	public function deleteLast()
	{
		$tempLink = $this->last;
		$this->last = $this->last->previous;
		return $tempLink->data;
	}

	public function isEmpty()
	{
		return ($this->first == null);
	}


	public function displayForward()
	{
		$current = $this->first;
		while($current != null){
			echo $current->data, '<br/>';
			$current = $current->next;
		}
	}

	public function displayBackend()
	{
		$current = $this->last;
		while($current != null){
			echo $current->data, '<br/>';
			$current = $current->previous;
		}
	}
}

$link = new LinkList();
$link->insertFirst('hello');
$link->insertFirst('a');
$link->insertFirst('b');

echo $link->deleteLast(), '<br/>';
echo $link->deleteLast(), '<br/>';
echo $link->deleteLast(), '<br/>';
