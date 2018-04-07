<?php

include "./AbstractSelfBalancingTree.php";

class AVLNode extends Node
{
    //当前节点数的高度
    public $height;
}

/**
 * AVL平衡树
 */
class AVLTree extends AbstractSelfBalancingTree
{
    //插入
    public function insert($data)
    {
        //1. 先判断当前节点是否需要进行平衡调整
        //2. 如果不需要则更新高度，换它的父节点来判断，依次进行下去，直到parent = null

        //当我插入一个新的节点，新节点是挂在某个叶子节点之下的
        //由于我的插入造成这个叶子节点的分支高度发生了变化，

        //因此重新计算这条分支上的所有节点的高度，同时判断是否失去平衡，失去平衡的节点需要重新调整

        $currentNode = parent::insert($data);
        $this->rebalance($currentNode);
        return $currentNode;
    }

    private function rebalance($node)
    {
        while($node != null)
        {
            $leftHeight = $node->left == null ? 0 : $node->left->height;
            $rightHeight = $node->right == null ? 0 : $node->right->height;

            $difference = $leftHeight - $rightHeight;

            //左子树要进行平衡调整
            if($difference == 2)
            {
                if($node->left->left != null)
                    //LL型调整
                    $this->avlRotateRight($node);
                else
                    //LR型调整
                    $this->avlRotateLeftRight($node);

                break;
            }
            //右子树要进行平衡调整
            else if($difference == -2)
            {
                if($node->right->right != null)
                    //RR
                    $this->avlRotateLeft($node);
                else
                    //RL型
                    $this->avlRotateRightLeft($node);

                break;
            }
            else
            {
                //更新节点高度
                $this->updateHeight($node);
            }
            $node = $node->parent;
        }
    }

    //avl左旋
    private function avlRotateLeft($node)
    {
        $balancingNode = $this->rotateLeft($node);

        $this->updateHeight($node);
        $this->updateHeight($balancingNode);
        return $balancingNode;
    }

    //avl右旋
    private function avlRotateRight($node)
    {
        $balancingNode = $this->rotateRight($node);
        $this->updateHeight($node);
        $this->updateHeight($balancingNode);
        return $balancingNode;
    }

    //LR型
    private function avlRotateLeftRight($node)
    {
        $this->avlRotateLeft($node->left);
        return $this->avlRotateRight($node);
    }

    //RL型
    private function avlRotateRightLeft($node)
    {
        $this->avlRotateRight($node->right);
        return $this->avlRotateLeft($node);
    }

    private function updateHeight($node)
    {
        $leftHeight = $node->left == null ? 0 : $node->left->height;
        $rightHeight = $node->right == null ? 0 : $node->right->height;
        $node->height = 1 + max($leftHeight, $rightHeight);
    }

    private function recomputeNode($node)
    {
        while($node != null)
        {
            $this->updateHeight($node);
            $node = $node->parent;
        }
    }

    //删除
    public function delete($data)
    {
        $deleteNode = parent::search($data);

        if($deleteNode != null)
        {
            $succerorNode = parent::delete($data);

            if($succerorNode == null)
            {
                //被删除节点可能是叶子节点
                $parentNode = $deleteNode->parent;
                $this->recomputeNode($parentNode);
                $this->rebalance($parentNode);
            }
            else
            {
                //被删除节点拥有孩子节点
                $minimum = $succerorNode->right == null
                    ? $succerorNode : $this->getMinium($succerorNode->right);

                $this->recomputeNode($minimum);
                $this->rebalance($minimum);
            }
            return $succerorNode;
        }

        return null;
    }
}
echo '<pre/>';

$tree = new AVLTree();

/*
$tree->insert(5);
$tree->insert(6);
$tree->insert(7);
$tree->insert(8);

$tree->insert(1);
$tree->insert(2);
$tree->insert(3);
$tree->insert(4);

//print_r($tree);

$r = $tree->delete(7);
//$tree->preorderDisplay();
$tree->inorderDisplay();
*/

$tree->insert(10);
$tree->insert(4);
$tree->insert(2);
$tree->insert(1);
$tree->insert(3);
$tree->insert(7);
$tree->insert(6);
$tree->insert(9);
$tree->insert(15);
$tree->insert(12);
$tree->insert(11);
$tree->insert(20);
$tree->insert(16);
$tree->insert(18);
$tree->insert(35);
$tree->insert(19);

$tree->delete(16);
//$tree->inorderDisplay();
$tree->preorderDisplay();

