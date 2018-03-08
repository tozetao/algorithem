<?php

class Node
{
    public $data;
    public $next;
    public $previous;

    public function __construct($dat)
    {
        $this->data = $dat;
    }
}

/*
 * 双向链表
 */
class ArrayList
{
    private $root;
    private $currentNode;

    public function __construct()
    {
        $this->currentNode = null;
    }

    public function insert($data)
    {
        $newNode = new Node($data);

        if(empty($this->root))
        {
            $this->root = $newNode;
            $this->currentNode = $newNode;
        }

        $this->currentNode->next = $newNode;
        $this->currentNode = $newNode;
    }

    public function remove()
    {
        if(empty($this->root)) return null;

        $temp = $this->root;
        $this->root = $this->root->next;
        return $temp;
    }

    public function display()
    {
        while(!empty($this->root))
        {
            echo $this->root->data, '<br/>';
            $this->root = $this->root->next;
        }
    }
}

$list = new ArrayList();
$list->insert(1);
$list->insert(2);
$list->insert(3);
$list->insert(4);

echo '<pre/>';
var_dump($list->remove()->data);
var_dump($list->remove()->data);
var_dump($list->remove()->data);
var_dump($list->remove()->data);
var_dump($list->remove());
