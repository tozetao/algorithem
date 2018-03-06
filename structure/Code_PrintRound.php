<?php

/**
 * 转圈打印矩阵
 */
class Code_PrintRound
{
    private $martix;

    private $startPoint;
    private $endPoint;

    private $flag;

    public function __construct()
    {
        $this->flag = true;
        /*
            1   2   3   4
            5   6   7   8
            7   10  11  12
            13  14  15  16
        */
        $this->martix = [
            [1, 2, 3],
            [5, 6, 7],
            [7, 10, 11],
            [13, 14, 15],
        ];

        $this->startPoint = [
            'x' => 0,
            'y' => 0
        ];
        $this->endPoint = [
            'x' => count($this->martix)-1,
            'y' => count(current($this->martix))-1,
        ];
    }

    public function display()
    {
        while($this->startPoint['x'] <= $this->endPoint['x'])
        {
            for($i = $this->startPoint['y']; $i < $this->endPoint['y']; $i++)
            {
                echo $this->martix[$this->startPoint['x']][$i], '&nbsp;&nbsp;&nbsp;';
            }

            for($j = $this->startPoint['x']; $j < $this->endPoint['x']; $j++)
            {
                echo $this->martix[$j][$this->endPoint['y']], '&nbsp;&nbsp;&nbsp;';
            }

            for($k = $this->endPoint['y']; $k > $this->startPoint['y']; $k--)
            {
                echo $this->martix[$this->endPoint['x']][$k], '&nbsp;&nbsp;&nbsp;';
            }

            for($f = $this->endPoint['x']; $f > $this->startPoint['x']; $f--)
            {
                echo $this->martix[$f][$this->startPoint['y']], '&nbsp;&nbsp;&nbsp;';
            }

            //更改坐标
            $this->startPoint['x']++;
            $this->startPoint['y']++;
            $this->endPoint['x']--;
            $this->endPoint['y']--;
        }
    }
}

$obj = new Code_PrintRound();
$obj->display();