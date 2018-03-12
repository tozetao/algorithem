<?php

include "Code2_List.php";

/*
 * 给定一个单向链表的头结点head，节点的值类型是整型，再给定一个数pivot，实现一个调整链表的函数，
 * 将链表调整为左边的值都是小于pivot，中间的值等于pivot，右边的值大于pivot。
 *
 * 要求空间要求为O(1)，且数据项的相对次序不变
 */
class SmallEqualBigger
{
    public static function listPartition($node, $pivot)
    {
        $sH = null;
        $sT = null;
        $eH = null;
        $eT = null;
        $bH = null;
        $bT = null;

        //下一个节点
        $next = null;

        while($node != null)
        {
            //存储下一个节点，并将当前节点置空
            $next = $node->next;
            $node->next = null;

            if($node->data < $pivot)
            {
                if($sT == null)
                {
                    $sH = $node;
                    $sT = $node;
                }else
                {
                    $sT->next = $node;
                    $sT = $node;
                }
            }
            else if($node->data > $pivot)
            {
                if($bT == null)
                {
                    $bT = $node;
                    $bH = $node;
                }else
                {
                    $bT->next = $node;
                    $bT = $node;
                }
            }
            else
            {
                if($eT == null)
                {
                    $eT = $node;
                    $eH = $node;
                }else{
                    $eT->next = $node;
                    $eT = $node;
                }
            }

            $node = $next;
        }

        if($sT != null)
        {
            $sT->next = $eH;
        }

        if($eT != null)
        {
            $eT->next = $bH;
        }

        return $sH != null ? $sH: ($eH != null ? $eH : $bH);
    }
}

$arrayList = new ArrayList();
$arrayList->insert(10);
$arrayList->insert(6);
$arrayList->insert(3);
$arrayList->insert(7);
$arrayList->insert(12);
$arrayList->insert(8);

$node = SmallEqualBigger::listPartition($arrayList->peek(), 12);
while($node != null)
{
    echo $node->data, '&nbsp;';
    $node = $node->next;
}