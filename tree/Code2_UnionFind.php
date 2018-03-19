<?php

class Node
{
    public $parent;
    public $count;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->parent = $this;
        //初始大小为1
        $this->count = 1;
    }
}

/**
 * 并查集
 */
class UnionFind
{
    public function isSameSet()
    {

    }

    public function findFather($node)
    {
        $parent = $node->parent;
        if($parent == $node)
            return $parent;

        $symbol = $this->findFather($parent);
        $node->parent = $symbol;
        return $symbol;
    }
}

$node = new Node(3);
$node->parent = new Node(2);
$node->parent->parent =  new Node(1);

$unionFind = new UnionFind();
$symobl = $unionFind->findFather($node);
echo '<pre/>';
var_dump($symobl);
