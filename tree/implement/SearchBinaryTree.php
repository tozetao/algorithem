<?php

include "./AbstractSearchBinaryTree.php";

class SearchBinaryTree extends AbstractSearchBinaryTree
{
    protected function createNode($data, $parent, $left, $right)
    {
        return new Node($data, $parent, $left, $right);
    }
}
/*
$tree = new SearchBinaryTree();
$tree->insert(4);
$tree->insert(2);
$tree->insert(1);
$tree->insert(3);
$tree->insert(6);
$tree->insert(5);
$tree->insert(7);
$tree->preorderDisplay();

$tree->delete(4);
echo '<br/>';
$tree->preorderDisplay();
*/
