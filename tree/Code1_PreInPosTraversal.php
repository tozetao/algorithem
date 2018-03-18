<?php

class Node
{
    public $left;
    public $right;
    public $val;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

/**
 * 二叉树的遍历
 */
class PreInPosTraversal
{
    //先序遍历
    public function preOrderRecursion($head)
    {
        if($head == null)
            return false;

        echo $head->val, '&nbsp;';
        $this->preOrderRecursion($head->left);
        $this->preOrderRecursion($head->right);
    }

    //中序遍历
    public function inOrderRecursion($head)
    {
        if($head == null)
            return null;

        $this->inOrderRecursion($head->left);
        echo $head->val, '&nbsp;';
        $this->inOrderRecursion($head->right);
    }

    //后序遍历
    public function posOrderRecursion($head)
    {
        if($head == null)
            return null;

        $this->posOrderRecursion($head->left);
        $this->posOrderRecursion($head->right);
        echo $head->val, '&nbsp;';
    }

    //先序遍历，非递归
    public function preOrderUnRecursion($head)
    {
        $stack = array();
        array_push($stack, $head);

        while(!empty($stack))
        {
            $node = array_pop($stack);
            echo $node->val, '&nbsp;';

            if($node->right != null)
                array_push($stack, $node->right);

            if($node->left != null)
                array_push($stack, $node->left);
        }
    }

    public function inOrderUnRecursion($head)
    {
        $stack = array();

        while(!empty($stack) || $head != null)
        {
            if($head != null)
            {
                array_push($stack, $head);
                $head = $head->left;
            }
            else
            {
                $item = array_pop($stack);
                $head = $item->right;
                echo $item->val, '&nbsp;';
            }
        }
    }

    public function posOrderUnRecursion($head)
    {
        $stack = array();
        $help = array();
        array_push($stack, $head);

        while(!empty($stack))
        {
            $current = array_pop($stack);
            array_push($help, $current);
            if($current->left)
                array_push($stack, $current->left);

            if($current->right)
                array_push($stack, $current->right);
        }

        while($item = array_pop($help))
            echo $item->val, '&nbsp;';
    }
}

$node = new Node(1);
$node->left = new Node(2);
$node->right = new Node(3);
$node->left->left = new Node(4);
$node->left->right = new Node(5);
$node->right->left = new Node(6);
$node->right->right = new Node(7);

$demo = new PreInPosTraversal();
$demo->preOrderRecursion($node);
echo '<br/>';
$demo->preOrderUnRecursion($node);
echo '<br/>', '<br/>';


$demo->inOrderRecursion($node);
echo '<br/>';
$demo->inOrderUnRecursion($node);
echo '<br/>', '<br/>';

$demo->posOrderRecursion($node);
echo '<br/>';
$demo->posOrderUnRecursion($node);

