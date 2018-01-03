<?php
/**
 * 最小堆
 */

class Stack
{
    //节点数量
    public $n;

    //数组，模拟完全二叉树
    public $array;



    //初始化

    //新增

    //删除

    //向下比较
    public function siftdown($i)
    {
        $flag = 0;
        $temp = null;   //临时存储节点

        //如果i节点拥有左子节点，则循环
        while($i*2<=$this->n && $flag === 0)
        {
            //判断i节点的值是否大于左子节点
            if($this->array[$i] > $this->array[$i*2])
                $temp = $i*2;
            else
                $temp = $i;

            //判断i节点是否大于右子节点
            if($i*2+1<=$this->n)
            {
                if($this->array[$i] > $this->array[$i*2+1])
                    $temp = $i*2+1;
            }

            //
            if($temp != $i)
            {
                $this->swap($i, $temp);
                $i = $temp;
            }else
            {
                //没有可交换的节点
                $flag = 1;
            }
        }
    }

    //向上比较
    public function siftup($i)
    {
        //1. 向上比较，判断父节点是否大于子节点
        //2. 如果条件成立，则交换俩个节点的值
        //3. 重复该过程直到根节点或条件不成立

        if($i == 1) return;

        while($i/2 >= 1)
        {
            if($this->array[$i/2] > $this->array[$i])
            {
                $this->swap($i, $i/2);
                $i/=2;
            }else
                break;
        }
    }

    private function swap($l, $j)
    {
        $temp = $this->array[$l];
        $this->array[$l] = $this->array[$j];
        $this->array[$j] = $temp;
    }

    //在堆首部插入一个数据
    public function insertFirst()
    {
        
    }

    //在堆中尾部插入一个数据项
    public function insertLast()
    {

    }

    //移除并返回堆中的最小数据项
    public function remove()
    {
        
    }

    public function create()
    {
        //把n个元素建立一个堆

        //1. 依次通过siftup(i)方法插入数据项，时间复杂度为O(NlogN);

        //2. 从上到下从左到右依次对n个元素进行1-n的编码存储到数组中，这样可以将n个元素转换成一颗完全二叉树，从这颗完全二叉树的最后一个非叶子节点开始检查每颗子树是否满足最小堆，当所有节点的子树都满足最小堆的要求，这棵树就符合最小堆的特性，它的时间复杂度是O(N)
    }

    //堆排序
    //每次删除顶部元素并将其放入一个数组中，直到堆为空。
    public function sort()
    {
        $temp = $this->array[1];

        $this->array[1] = $this->array[$this->n];
        $this->siftdown(1);
        $this->n--;

        return $temp;
    }
}