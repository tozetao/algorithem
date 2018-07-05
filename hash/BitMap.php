<?php

class BitMap
{
    private $bitMap;
    private $size;

    public function __construct()
    {
        $this->bitMap = array();
        $this->size = 32;
    }

    /**
     * 对指定偏移量上的bit位进行赋值
     */
    public function setbit($offset, $value)
    {
        if($offset < 0)
            throw new Exception('offset less than zero.');

        if($value !== 0 && $value !== 1)
            throw new Exception('wrong parameter.');

        //计算偏移量对应的索引
        $index = floor($offset / $this->size);

        //计算在索引元素上要移动的bit位数
        $move = $offset % $this->size;

        if(!isset($this->bitMap[$index]))
            $this->bitMap[$index] = 0;

        if($value === 0)
        {
            $this->bitMap[$index] |= (1 << $move);
            $this->bitMap[$index] ^= (1 << $move);
        }
        else
        {
            $this->bitMap[$index] |= (1 << $move);
        }
    }

    public function getbit($offset)
    {
        $index = floor($offset, $this->size);
        $move  = $offset % $this->size;

        $t = $this->bitMap[$index];
        $m = 1 << $move;
        $t = $t & (1<<$move);

        return $m == $t ? 1 : 0;
    }
}

$bitmap = new BitMap();

$bitmap->setbit(0, 0);
$bitmap->setbit(10, 1);     //1024 10%32 => 2^10
$bitmap->setbit(90, 1);
$bitmap->display();

$bitmap->setbit(10, 0);
$bitmap->display();
