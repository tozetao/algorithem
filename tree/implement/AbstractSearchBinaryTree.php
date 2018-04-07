<?php

class Node
{
    public $data;
    public $left;
    public $right;
    public $parent;

    public function __construct($data, $parent, $left, $right)
    {
        $this->data = $data;
        $this->parent = $parent;
        $this->left = $left;
        $this->right = $right;
    }

    public function isLeaf()
    {
        return ($this->left == null && $this->right == null);
    }
}

/**
 * 抽象二叉搜索树
 */
class AbstractSearchBinaryTree
{
    public $root;

    protected function createNode($data, $parent, $left, $right)
    {
        return new Node($data, $parent, $left, $right);
    }

    //insert
    public function insert($data)
    {
        if($this->root == null)
        {
            $this->root = $this->createNode($data, null, null, null);
            return $this->root;
        }

        $searchNode = $this->root;
        $parentNode = null;

        while($searchNode != null
            && $searchNode->data != $data)
        {
            $parentNode = $searchNode;

            if($data > $searchNode->data)
            {
                $searchNode = $searchNode->right;
            }else
            {
                $searchNode = $searchNode->left;
            }
        }

        //相等的数值这里不做处理

        $newNode = $this->createNode($data, $parentNode, null, null);
        if($data > $parentNode->data)
        {
            $parentNode->right = $newNode;
        }
        else
        {
            $parentNode->left = $newNode;
        }

        return $newNode;
    }

    //search
    public function search($data)
    {
        $searchNode = $this->root;

        while($searchNode != null
            && $searchNode->data != $data)
        {
            if($data > $searchNode->data)
                $searchNode = $searchNode->right;
            else
                $searchNode = $searchNode->left;
        }

        return $searchNode;
    }

    //delete
    public function delete($data)
    {
        $searchNode = $this->search($data);

        if(!$searchNode)
            return $searchNode;

        $nodeToReturn = null;

        //删除一个节点有3种情况
        if($searchNode->left == null)
        {
            $nodeToReturn = $this->transplant($searchNode, $searchNode->right);
        }
        else if($searchNode->right == null)
        {
            $nodeToReturn = $this->transplant($searchNode, $searchNode->left);
        }
        else
        {
            //如果左右子节点都有的情况，使用删除节点的后继节点来替代它
            $successorNode = $this->getMinium($searchNode->right);

            if($successorNode != $searchNode->right)
            {
                $this->transplant($successorNode, $successorNode->right);
                $successorNode->right = $searchNode->right;
                $successorNode->right->parent = $successorNode;
            }

            $this->transplant($searchNode, $successorNode);
            $successorNode->left = $searchNode->left;
            $successorNode->left->parent = $successorNode;
            $nodeToReturn = $successorNode;
        }

        return $nodeToReturn;
    }

    //返回后继节点
    public function getMinium($node)
    {
        while($node->left != null)
            $node = $node->left;

        return $node;
    }

    //返回先驱节点
    public function getMaxium($node)
    {

    }

    //使用新节点替代另外一个节点的环境
    public function transplant($nodeToReplace, $newNode)
    {
        if($nodeToReplace->parent == null)
        {
            $this->root = $newNode;
        }
        else if($nodeToReplace == $nodeToReplace->parent->left)
        {
            $nodeToReplace->parent->left = $newNode;
        }
        else if($nodeToReplace == $nodeToReplace->parent->right)
        {
            $nodeToReplace->parent->right = $newNode;
        }

        if($newNode != null)
            $newNode->parent = $nodeToReplace->parent;

        return $newNode;
    }

    private function preorder($node)
    {
        if($node == null) return null;

        echo $node->data, "\n";

        $this->preorder($node->left);
        $this->preorder($node->right);
    }

    public function preorderDisplay()
    {
        $this->preorder($this->root);
    }

    private function inorder($node)
    {
        if($node == null)
            return;

        $this->inorder($node->left);

        echo $node->data, "\n";

        $this->inorder($node->right);
    }

    public function inorderDisplay()
    {
        $this->inorder($this->root);
    }
}













