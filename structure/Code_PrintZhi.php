<?php

/*
 * 之字型打印矩阵
 *
 * 1  3  5  9
 * 4  2  6  10
 * 11 21 20 40
 */
class PrintZhi
{
    private $martix;

    private $flag;

    private $topPoint;
    private $bottomPoint;

    public function __construct()
    {
        $this->martix = [
            [1, 3, 5, 9],
            [2, 4, 6, 10],
            [3, 11, 10, 20],
            [3, 11, 10, 20],
        ];
        $this->topPoint = [
            'x' => 0,
            'y' => 0
        ];
        $this->bottomPoint = [
            'x' => 0,
            'y' => 0
        ];

        $this->flag = false;
    }

    //
    public function display()
    {
        while($this->topPoint['x'] < count($this->martix)
        && $this->topPoint['y'] < count(current($this->martix)))
        {
            if($this->flag)
            {
                //从下往上打印
                $x = $this->bottomPoint['x'];
                $y = $this->bottomPoint['y'];
                while($x >= $this->topPoint['x'] && $y <= $this->topPoint['y'])
                {
                    echo $this->martix[$x][$y], '&nbsp;';
                    $x--;
                    $y++;
                }
                $this->flag = false;
            }else{
                //从上往下打印
                $x = $this->topPoint['x'];
                $y = $this->topPoint['y'];
                while($x <= $this->bottomPoint['x'] && $y >= $this->bottomPoint['y'])
                {
                    echo $this->martix[$x][$y], '&nbsp;';
                    $x++;
                    $y--;
                }
                $this->flag = true;
            }


            if($this->topPoint['y'] < count(current($this->martix)) -  1)
            {
                $this->topPoint['y']++;
            }else{
                $this->topPoint['x']++;
            }


            if($this->bottomPoint['x'] < count($this->martix) - 1)
            {
                $this->bottomPoint['x']++;
            }else{
                $this->bottomPoint['y']++;
            }
        }
    }
}

$obj = new PrintZhi();
$obj->display();
