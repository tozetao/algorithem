<?php

include "./Code2_List.php";

/*
题目：
    俩个单链表相交的一系列问题

    在本题中，单链表可能有环，也可能无环，给定俩个单链表的头节点head1和head2，
    这俩个链表可能相交也可能不相交。请实现一个函数，如果俩个链表相交，请返回相交的第一个节点，
    如果不相交，返回null。

    要求：如果链表1的长度为n，链表2的长度为m，时间复杂度要达到O(N+M)，额外空间复杂度为O(1)

 */
class IntersectNode
{
    //返回相交的节点
    public function getIntersectNode($link1, $link2)
    {
        $loop1 = $this->findLoopNode($link1);
        $loop2 = $this->findLoopNode($link2);

        //俩个无环链表的处理
        if(!$loop1 && !$loop2)
            return $this->noLoop($link1, $link2);

        //俩个有环链表的处理
        if($loop1 != null && $loop2 != null)
            return $this->bothLoop($link1, $link2);

        return null;
    }

    //查询链表的入环节点
    public function findLoopNode($link)
    {
        $slow = $link;
        $fast = $link;

        $flag = false;

        while($fast->next != null && $fast->next->next != null)
        {
            $fast = $fast->next->next;
            $slow = $slow->next;

            if($fast == $slow)
            {
                $flag = true;
                break;
            }
        }

        if(!$flag) return false;

        //寻找入环点
        $fast = $link;
        while($fast != $slow)
        {
            $fast = $fast->next;
            $slow = $slow->next;
        }
        return $fast->data;
    }
    
    //俩个无环链表的处理
    public function noLoop($link1, $link2)
    {
        $length1 = 0;
        $length2 = 0;

        //计算俩个链表长度
        $tlink1 = $link1;
        $tlink2 = $link2;

        while($tlink1 != null)
        {
            $length1++;
            $tlink1 = $tlink1->next;
        }

        while($tlink2 != null)
        {
            $length2++;
            $tlink2 = $tlink2->next;
        }

        $dval = abs($length1-$length2);
        
        if($length1 > $length2)
        {
            for($i = 0; $i<$dval; $i++)
                $link1 = $link1->next;
        }
        else if($length1 < $length2)
        {
            for($i = 0; $i<$dval; $i++)
                $link2 = $link2->next;
        }

        while($link1 != null && $link2 != null)
        {
            if($link1 == $link2)
                return $link1;

            $link1 = $link1->next;
            $link2 = $link2->next;
        }

        return false;
    }

    //俩个有环链表的处理
    public function bothLoop($link1, $link2, $loop1, $loop2)
    {
        //A链表指向B链表的非环节点
        if($loop1 == $loop2)
        {
            $n = 0;
            $curr1 = $link1;
            $curr2 = $link2;

            while($curr1 != $loop1)
            {
                $n++;
                $curr1 = $curr1->next;
            }
            while($curr2 != $loop1)
            {
                $n--;
                $curr2 = $curr2->next;
            }

            //判断哪个链表长
            $curr1 = ($n > 0) ? $link1 : $link2;
            $curr2 = ($curr1 == $link1) ? $link2: $link1;

            while($n != 0)
            {
                $curr1 = $curr1->next;
                $n--;
            }

            while($curr1 != $curr2)
            {
                $curr1 = $curr1->next;
                $curr2 = $curr2->next;
            }
            return $curr1;
        }
        else
        {
            $curr = $loop1->next;

            while($curr != $loop1)
            {
                if($curr == $loop2)
                    return $loop1;

                $curr = $curr->next;
            }

            return null;
        }
    }
}

$n1 = new Node(1);
$n2 = new Node(2);
$n3 = new Node(3);
$n4 = new Node(4);
$n5 = new Node(5);

$n10 = new Node(10);
$n11 = new Node(11);
$n12 = new Node(12);

$n1->next = $n2;
$n2->next = $n3;
$n3->next = $n4;
$n4->next = $n5;
$n5->next = $n4;

$n10->next = $n11;
$n11->next = null;

echo '<pre/>';

//俩个无环链表是否相交
$obj = new IntersectNode();
//var_dump($intersect->isIntersect($n1, $n10));

//链表是否有环
var_dump($obj->isRing($n1));
