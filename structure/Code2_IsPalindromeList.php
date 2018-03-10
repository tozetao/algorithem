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
    public $arrayList;

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
        //寻找中间节点
        $slow = $this->arrayList->peek();
        $fast = $this->arrayList->peek();

        while($fast->next != null && $fast->next->next != null)
        {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        //将左右俩部分节点进行对比
        $stack = new Stack(10);
        while($slow->next != null)
        {
            $stack->push($slow->next);
            $slow = $slow->next;
        }

        $link = $this->arrayList->peek();

        while(!$stack->isEmpty())
        {
            if($stack->pop()->data != $link->data)
                return false;

            $link = $link->next;
        }
        return true;
    }

    public function O1Check()
    {
        //寻找中间节点
        $slow = $this->arrayList->peek();
        $fast = $this->arrayList->peek();

        while($fast->next != null && $fast->next->next != null)
        {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        //1. 取得右半节点的头节点
        //2. 将右半部分链表的指针指向方向逆反

        $flat = true;

        $start = $this->arrayList->peek();
        $current = $slow->next;
        $slow->next = null;

        $reverseNode = $this->reverseNode($current);
        $tmp = $reverseNode;

        while($reverseNode != null)
        {
            if($reverseNode->data != $start->data)
            {
                $flat = false;
                break;
            }

            $reverseNode = $reverseNode->next;
            $start = $start->next;
        }

        $current = $this->reverseNode($tmp);
        $slow->next = $current;
        return $flat;
    }

    /*
     * 反转一个链表
     * @param $current          当前节点项
     * @param null $provious    默认指向的上一个节点
     * @return mixed
     */
    public function reverseNode($current, $provious = null)
    {
        while(($tmp = $current->next) != null)
        {
            $current->next = $provious;
            $provious = $current;
            $current = $tmp;
        }

        $current->next = $provious;
        return $current;
    }

    public function display()
    {
        $this->arrayList->display();
    }
}

$arrayList = new ArrayList();
$arrayList->insert(1);
$arrayList->insert(2);
$arrayList->insert(3);
$arrayList->insert(4);
//$arrayList->insert(3);
$arrayList->insert(2);
$arrayList->insert(1);

echo '<pre/>';
$obj = new Code2_IsPalindromeList($arrayList);
//var_dump($obj->check());

var_dump($obj->O1Check());
$obj->display();

//
//$reverse = $obj->reverseNode($arrayList->peek());
//print_r($reverse);
//$zheng = $obj->reverseNode($reverse);