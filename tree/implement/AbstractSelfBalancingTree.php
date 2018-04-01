<?php

include "./AbstractSearchBinaryTree.php";

/**
 * 抽象自平衡树
 */
class AbstractSelfBalancingTree extends AbstractSearchBinaryTree
{
    //向左旋转
    public function rotateLeft($node)
    {
        //1. 让平衡节点去替代旋转节点的环境
        $balancingNode = $node->right;
        $balancingNode->parent = $node->parent;

        if($node->parent != null)
        {
            if($node == $node->parent->left)
                $node->parent->left = $balancingNode;
            else
                $node->parent->right = $balancingNode;
        }
        else
        {
            $this->root = $balancingNode;
        }

        //2. 将平衡节点的左分支挂到旋转节点的右分支上
        $node->right = $balancingNode->left;
        if($balancingNode->left != null)
            $balancingNode->left->parent = $node;

        //3. 将旋转节点挂在平衡节点的左分支上
        $balancingNode->left = $node;
        $node->parent = $balancingNode;

        return $balancingNode;
    }

    //向右旋转
    public function rotateRight($node)
    {
        //1. 让平衡节点去替代旋转节点的环境
        $balancingNode = $node->left;
        $balancingNode->parent = $node->parent;

        if($node->parent != null)
        {
            if($node == $node->parent->left)
                $node->parent->left = $balancingNode;
            else
                $node->parent->right = $balancingNode;
        }
        else
        {
            $this->root = $balancingNode;
        }

        //2. 将平衡节点的右分支挂到旋转节点的左分支上
        $node->left = $balancingNode->right;
        if($balancingNode->right != null)
        {
            $balancingNode->right->parent = $node;
        }

        //3. 将旋转节点挂在平衡节点的右分支上
        $balancingNode->right = $node;
        $node->parent = $balancingNode;

        return $balancingNode;
    }
}