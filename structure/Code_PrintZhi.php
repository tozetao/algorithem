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

    private $tR;
    private $tC;
    private $bR;
    private $bC;

    public function __construct()
    {
        $this->martix = [
            /*[1],
            [3],
            [4],
            [9],
            */
            [1, 3, 5, 9],
            [2, 4, 6, 10],
            [3, 11, 10, 20]

        ];

        $this->tC = 0;
        $this->tR = 0;
        $this->bC = 0;
        $this->bR = 0;

        $this->flag = true;
    }

    //
    public function display()
    {
        $numRow = count($this->martix)-1;
        $numColumn = count(current($this->martix))-1;

        while($this->tR != $numRow+1)
        {
            $this->printLevel($this->tR, $this->tC, $this->bR, $this->bC, $this->flag);

            $this->tR = ($this->tC == $numColumn) ? $this->tR+1 : $this->tR;
            $this->tC = ($this->tC == $numColumn) ? $this->tC : $this->tC+1;

            $this->bR = ($this->bR == $numRow) ? $this->bR : $this->bR+1;
            $this->bC = ($this->bR == $numRow) ? $this->bC+1 : $this->bC;


            $this->flag = !$this->flag;
        }

    }

    private function printLevel($tR, $tC, $bR, $bC, $flag)
    {
        echo $tR, '&nbsp;', $tC, '&nbsp;', $bR, '&nbsp;', $bC, '<br/>';
        if($flag)
        {
            //从下向上打印
            //x-1, y+1
            while($bR != $tR-1)
            {
                echo $this->martix[$bR--][$bC++], '&nbsp;', '<br/><br/>';
            }
        }
        else
        {
            //从上向下打印
            //x+1, y-1
            while($tR != $bR+1)
            {
                echo $this->martix[$tR++][$tC--], '&nbsp;', '<br/><br/>';
            }
        }
    }
}

$obj = new PrintZhi();
$obj->display();



/*
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
        */