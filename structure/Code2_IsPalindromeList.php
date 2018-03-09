<?php

include "Code2_List.php";
include "Code1_Stack.php";

/*
 * 问题：
 *     判断一个链表是否回文链表，要求空间复杂度是O(1)
 *
 * 解答：
 *     定义一个快指针，一个慢指针，快指针走俩步，慢指针走一步，
 *     当快指针到达链表底部或者越界时，慢指针将会在链表的中部。
 *
 *
 * 1 2 3 4 3 2 1
 *
 * 1 -> 2 -> 3 -> 4(->null) <- 3 <- 2 <-1，4指向null
 *
 * 1 2 3 3 2 1
 * 1 -> 2 -> 3 -> null <- 3 <- 2 <-1
 */
class Code2_IsPalindromeList
{
    private $arrayList;

    public function __construct($arrayList)
    {
        $this->arrayList = $arrayList;
    }

    /*
        $node->next->next
        1. 能够走到中间点，
        2. 将中间点到链表尾部的节点加入到栈中
        3. 从栈中弹出节点 并与 链表的节点进行对比，如果全部相等则是回文，否则不是回文
    */

    public function check()
    {
        //指向链表头节点
        $slow = $this->arrayList->peek();
        $fast = $this->arrayList->peek();

        while($fast->next != null && $fast->next->next != null)
        {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        $stack = new Stack(10);
        while($slow != null)
        {
            $stack->push($slow->next);
            $slow = $slow->next;
        }

//        while()
    }

    public function O1Check()
    {
        
    }
}

$arrayList = new ArrayList();
$arrayList->insert(1);
$arrayList->insert(2);
$arrayList->insert(3);
//$arrayList->insert(4);
$arrayList->insert(3);
$arrayList->insert(2);
$arrayList->insert(1);

echo '<pre/>';
$list = new Code2_IsPalindromeList($arrayList);
print_r($list->check());