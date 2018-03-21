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
    //寻找一个集合的代表节点，并将节点链打平
    public function findFather($node)
    {
        $parent = $node->parent;

        if($parent != $node)
            $parent = $this->findFather($parent);

        $node->parent = $parent;
        return $parent;
    }

    //是否相同集合
    public function isSameSet($nodeA, $nodeB)
    {
        $result = $this->findFather($nodeA) === $this->findFather($nodeB);
        return $result;
    }

    //将俩个集合合并成一个集合
    public function union($nodeA, $nodeB)
    {
        $symoblA = $this->findFather($nodeA);
        $symoblB = $this->findFather($nodeB);

        if($symoblA !== $symoblB)
        {
            if($symoblA->count <= $symoblB->count)
            {
                $symoblA->parent = $symoblB;
                $symoblB->count += $symoblA->count;
            }else
            {
                $symoblB->parent = $symoblA;
                $symoblA->count += $symoblB->count;
            }
        }
    }
}

$node3 = new Node(3);
$node2 = new Node(2);
$node1 = new Node(1);

$unionFind = new UnionFind();
$unionFind->union($node1, $node2);
$unionFind->union($node1, $node3);

echo '<pre/>';
print_r($node1);
print_r($node3);

var_dump($unionFind->isSameSet($node1, $node2));
var_dump($unionFind->isSameSet($node1, $node3));
var_dump($unionFind->isSameSet($node3, $node2));