<?php
/*
 * 问题：
 *     在随机数组中找到第K大的数
 *
 * 解答：
 *     从数组中随机找出一个元素X，将数组划分成SA和SB俩部分，SA是大于X的部分，SB是小于等于X的部分，这时候将会有俩种情况：
 *     1. SA的元素个数小于K，则SB中的K-|SA|位置就是第K大数，|SA|指SA的元素个数
 *     2. SA的元素个数大于等于K，则需要返回SA中最大的K个元素
 *     继续划分下去直到basecase.
 *
 *     假设哨兵(中间数)是M，low是SA起始索引，basecase是 M-low+1 == k，即一直划分过程中，左半部分刚好是第k大的数。
 */
class FindK
{
    public function find($array, $k, $left, $right)
    {
        //partition
        $p = $this->partition($array, $left, $right);

        //basecase
        $leftParts = $p-$left+1;

        if($leftParts == $k)
            return $array[$p];

        if($leftParts > $k)
            return $this->find($array, $k, $left, $p-1);
        else
            return $this->find($array, $k-$leftParts, $p+1, $right);
    }

    //partition，分割成左边是大于等于X，右边是小于X
    public function partition(&$array, $left, $right)
    {
        $more = $left-1;
        $pivot = mt_rand($left, $right);
        $this->swap($array, $pivot, $right);

        while($left <= $right)
        {
            if($array[$left] >= $array[$right])
            {
                $this->swap($array, ++$more, $left);
            }
            $left++;
        }

        return $more;
    }

    private function swap(&$array, $left, $right)
    {
        $tmp = $array[$left];
        $array[$left] = $array[$right];
        $array[$right] = $tmp;
    }
}

$array = [5, 10, 8, 1, 4, 9, 100];
$obj = new FindK();
echo $obj->find($array, 4, 0, count($array)-1);