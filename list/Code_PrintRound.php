<?php

/**
 * 转圈打印矩阵
 */
class Code_PrintRound
{
    private $martix;


    private $tR;
    private $tC;
    private $bR;
    private $bC;

    private $flag;

    public function __construct()
    {

        /*
            1   2   3   4
            5   6   7   8
            7   10  11  12
            13  14  15  16
        */
        $this->martix = [
            /*[1, 2],
            [3, 4],
            [5, 6],
            [7, 20],
            [7, 10],
            [11, 29]*/

            [5, 6, 3],
            [7, 20, 3],
//            [7, 10, 4],
        ];

        $this->tC = 0;
        $this->tR = 0;
        $this->bC = count(current($this->martix)) - 1;
        $this->bR = count($this->martix) - 1;
        $this->flag = true;
    }

    public function display()
    {
        $endR = count($this->martix);
        $endC = count(current($this->martix));

        while($this->tR <= $this->bR && $this->tC <= $this->bC)
        {
//            echo $this->tR, '&nbsp;', $this->tC, '&nbsp;&nbsp;', $this->bR, '&nbsp;' . $this->bC, '<br/>';

            //只有一行数据
            if($this->tR == $endR-1)
            {
                for($i=$this->tC; $i<$endC1; $i++)
                    echo $this->martix[$this->tR][$i], '&nbsp;&nbsp;&nbsp;';

            }
            //只有一列数据
            else if($this->tC == $endC-1)
            {
                for($i=$this->tR; $i<$endR; $i++)
                    echo $this->martix[$i][$this->tC], '&nbsp;&nbsp;&nbsp;';
            }else
            {
                for($i=$this->tC; $i<$this->bC; $i++)
                    echo $this->martix[$this->tR][$i], '&nbsp;&nbsp;&nbsp;';

                for($i=$this->tR; $i<$this->bR; $i++)
                    echo $this->martix[$i][$this->bC], '&nbsp;&nbsp;&nbsp;';

                for($i=$this->bC; $i>$this->tC; $i--)
                    echo $this->martix[$this->bR][$i], '&nbsp;&nbsp;&nbsp;';

                for($i=$this->bR; $i>$this->tR; $i--)
                    echo $this->martix[$i][$this->tC], '&nbsp;&nbsp;&nbsp;';

            }

            $this->tR++;
            $this->tC++;
            $this->bR--;
            $this->bC--;
        }
    }
}

$obj = new Code_PrintRound();
$obj->display();